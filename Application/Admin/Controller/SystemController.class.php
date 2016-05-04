<?php
//属于admin目录下面的控制器 也就是说来控制admin这个文件夹的

namespace Admin\Controller;
use Think\Controller;
class SystemController extends PublicController {

	//入口加载方法 默认登录界面
    // public function index(){	
    // 	 //视图名+页面名
    //   $this->display("main/index"); //默认本控制器下面的界面  也就是说是Index文件夹下面
    //    // $this->display("Main/index");//测试 正确
    // }
    
    


    public function system_base(){
        $this->display("System/system_base");
    }

     public function system_category(){
         //无极分类使用
        // $arr=array();
        // category($arr);
        // $this->assign("arr",$arr);  这段代码已经在PublicController 里面继承下来了所以在其他地方都能够使用这个无极分类的查询滴 
        
        $this->display("System/system_category");
    }

     public function system_data(){
        $this->display("System/system_data");
    }

     public function system_shielding(){
        $this->display("System/system_shielding");
    }

    public function system_category_del(){
        $db=M('category');
        $alllist=$db->select();
        if(IS_POST){
            //ajax传需要被删除的id
            $cat_id=I('id');
            // echo $cat_id;die;
            //判断删除的类型是单个还是多个
            $type=I('type'); 
            if($type=="one"){
                
                // $b=1;//$db->delete($cat_id);
                $b=$db->delete($cat_id);
               
                $list=get_child_id($alllist,$cat_id);

                $arr_id=array();
                // print_r($list);
                foreach ($list as $v) {
                    $arr_id[]=$v['cat_id'];
                    $db->delete($v['cat_id']);

                }

                if($b){
                    $list=get_child_id($alllist,$cat_id);    

                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功","arr_id"=>$arr_id));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }
            }else if($type=="all"){
                $b=1;//$db->delete($cat_id);
               

                $cat_id=explode(",",  $cat_id);


                $arr_id=array();


                foreach ($cat_id as $v) {

                     $list=get_child_id($alllist,$v);

                     // print_r($list);die;
                    foreach ($list as $v) {
                        $arr_id[]=$v['cat_id'];
                        $db->delete($v['cat_id']);

                    }
                }


                $arr_id=array_unique($arr_id);
                // echo $db->getLastSql();die;
                if($b){
                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功","arr_id"=>$arr_id));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }
            }

        }

    }



    public function  system_category_changestatu(){
            $db=M("category");
            // $cat_id=I('id');
            $type=I("type");

            $where['cat_id']=I('id');

            if($type=="start"){
                $is_show['is_show']=1;
                $b=$db->where($where)->save($is_show);

                if($b){
                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }


            }else if($type=="stop"){

                $is_show['is_show']=0;
                $b=$db->where($where)->save($is_show);

                if($b){
                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }     


            }
    }




     public function system_category_add(){
        $db=M("category");

        $db2=M("type");
        $list=$db2->select();
        // var_dump($list);die;
        $this->assign("typelist",$list);
        
        if(IS_POST){
                //从隐藏域中接收到传过来的值
                $cat_id=I('cat_id',0);
                
                    //如果大于0则做修改
                    if($cat_id>0){
                       //小于0则做添加
                        $_POST['is_show']=I("is_show",0);
                        //如果type_id 小于0则做添加
                        $b=$db->save($_POST);
                        if($b){
                            $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                        }else{
                            $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                        }


                    }else{
                        //小于0则做添加
                        $_POST['is_show']=I("is_show",0);
                        //如果type_id 小于0则做添加
                        $b=$db->add($_POST);
                        if($b){
                            $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                        }else{
                            $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                        }
                    }



              
        }else{
            $cat_id=I('cat_id');
            $signcate=$db->find($cat_id);
            // echo $db->getLastSql();
            // var_dump($signcate);
            $this->assign("signcate",$signcate);
            //将所有的类型都查过去赋值到本页面
            $this->display("System/system_category_add");
        }

        

       
    }






     public function system_log(){
        $this->display("System/system_log");
    }










    //类型表操控 查出所有的类型表 这里有一个假的分页 只是做测试
    public function system_type(){
        $db=M('type');
       
        $where=" 1=1 ";

        //TP 分页
        //如果是从表单提交过来的则进行模糊查询 我这里的分页有bug  只差这个分页bug了  还有修改功能没有做还有那个更改当前状态的功能没有做
        if(IS_POST){
             $content=I('searchcontent',"");
             $where.=" and type_name like '%$content%' or type_id like '%$content%'";
        }

        
        $count=$db->count();

        $page       = new \Think\Page($count,3);//
        $list = $db->where($where)->limit($page->firstRow.','.$page->listRows)->select(); 
        $page->setConfig("prev","上一页");
        $page->setConfig("first","第一页");
        $page->setConfig("next","下一页");
        $page->setConfig("end","最后一页");
        $show       = $page->show();
        $this->assign('typelist',$list);
        $this->assign('page',$show);
        $this->display("System/system_type");






    }

    public function system_type_add(){
        $db=M('type');
        //该句类似于unset 是否存在  如果存在则赋值，如果不存在默认为0 
        if(IS_POST){
            //如果存在，则修改
                 $type_id=I('type_id',0);
                //否则做增加
                //$this->ajaxReturn(1);
                if($type_id>0){
                    $b=$db->save($_POST);
                    if($b){
                        $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                    }else{
                        $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                    }
                }else{
                    //如果type_id 小于0则做添加
                    $b=$db->add($_POST);
                    if($b){
                        $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                    }else{
                        $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                    }
                }
           


        }else{
            //这里作判断  如果不是表示传过来的值  则将它赋值到本页面
            $type_id=I('type_id',0);
            $list=$db->find($type_id);
            $this->assign("typelist",$list);
            $this->display();
        }
    }



    public function system_type_del(){
        $db=M('type');
        if(IS_POST){
            //ajax传需要被删除的id
            $type_id=I('type_id');
            //判断删除的类型是单个还是多个
            $type=I('type'); 
            if($type="one"){
                $b=$db->delete($type_id);
                if($b){
                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }
            }else if($type="all"){
                $b=$db->delete($type_id);
                if($b){
                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }
            }

        }
    }







}