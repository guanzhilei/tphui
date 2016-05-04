<?php
//属于admin目录下面的控制器 也就是说来控制admin这个文件夹的

namespace Admin\Controller;
use Think\Controller;
class ProductController extends Controller {


    public function product_list(){
        $this->display();
    }

    public function product_category(){
        $this->display();
    }

    public function product_category_add(){
        $this->display();
    }

    public function product_add(){
        $this->display();
    }

    public function product_aaa(){
        $start = I('start');
        $limit = I('length');
        $iorder = (I('order'));
        $icolumn = (I('columns'));
        $db=M('brand');
        $order=array($icolumn[$iorder[0]['column']]['data']=>$iorder[0]['dir']);
        $isearch = I('search');
        $isearch['value']?$where="`BRAND_NAME` like '%$isearch[value]%'":$where='';
        $list=$db->where($where)->limit($start,$limit)->order($order)->select();
        $num =$db->where($where)->count();
        $num==0?$list=array():'';
        $data = array(  
            'iTotalRecords' => $num,//数据的总条数  
            'iTotalDisplayRecords' => $num,//显示的条数  
            'aaData' => $list //此处为我们的list数据也就是从数据库中取出来的了  
        );
    echo json_encode($data);  
    }

    public function product_brand(){
        $db=M('brand');

        $where=" 1=1 ";

        if(IS_POST){

            //开始做模糊查询
            $cat_id=I("cat_id");
            $content=I("content");  

            $where.=" and brand_name like '%$content%'";
            if($cat_id>0){
                 $where.=" and cat_id={$cat_id} ";
            }

           

        }




        $db3=M("category");
        $catelist2=$db3->select();
        $this->assign("catelist2",$catelist2);

        $list=$db->where($where)->select();

        // echo $db->getLastSql();die;

        $this->assign("brandlist",$list);
        $this->display("Product/product_brand");
    }

      public function product_brand_add(){
        $db=M("brand");

        if(IS_POST){
                //从隐藏域中接收到传过来的值
                $brand_id=I('brand_id',0);
                
                    //如果大于0则做修改
                    if($brand_id>0){
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
            //不晓得这里是不是可以就这样子直接分配出去后在别的地方也能用
            //这里有一个没有做好的是 将变量分配出去的时候要考试内存空间问题记得变量只要分配一次就行，下次注意
            $db2=M("type");
            $db3=M("category");

            $typelist2=$db2->select();
            $catelist2=$db3->select();

            $this->assign("typelist2",$typelist2);
            $this->assign("catelist2",$catelist2);

            $brand_id=I('brand_id');
            $signcate=$db->find($brand_id);
            // echo $db->getLastSql();
            // var_dump($signcate);
            $this->assign("signbrand",$signcate);
            //将所有的类型都查过去赋值到本页面
            $this->display("Product/product_brand_add");
        }

        

       
    }
	

    public function product_brand_del(){
        $db=M('brand');
        if(IS_POST){
            //ajax传需要被删除的id
            $brand_id=I('id');
            // echo $cat_id;die;
            //判断删除的类型是单个还是多个
            $type=I('type'); 
            // echo $type;die;
            if($type=="one"){
                $img=$db->where($brand_id)->getField('brand_img');

                $b=$db->delete($brand_id);
                // echo $img;die;
                if($b){
                    $iss=is_file(".".$img);
                    if($iss){
                        unlink(".".$img);
                    }


                    
                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }
            }else if($type=="all"){
                //这里要将字符串变成一个数组
                //这里是图片删除 
                
                // echo $imglist;die;
                //我不知道这里的逻辑是什么  但是如果我$b里面的brand_id 先删除再查的话会根本查到了删除不掉好么？ 好伤心 果然是先查后删除
                $where['brand_id']=array("in",rtrim($brand_id,","));
                $list=$db->where($where)->select();
                $b=$db->delete($brand_id);
               
                // echo $db->getLastSql();die;
                if($b){
                    // print_r($list);
                   
                    foreach ($list as $v) {
                        

                       unlink(".".$v['brand_img']);
                    }

                   
                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }
            }

        }

    }

















}