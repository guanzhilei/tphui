<?php
//属于admin目录下面的控制器 也就是说来控制admin这个文件夹的

namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    //在继承它的时候就将无极分类查询出来供子类使用
	public function _initialize(){
         $arr=array();
        category($arr);
        $this->assign("arr",$arr);
    }
    //分件上传  图片上传
    public function uploadImg(){
    	$path=I("get.path");

    	$upload = new \Think\Upload();// 实例化上传类    
    	$upload->maxSize   =     3145728 ;// 设置附件上传大小    
    	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
    	$upload->savePath  =      $path.'/'; // 设置附件上传目录    // 上传文件     
    	// $info   =   $upload->upload();  
    	$info   =   $upload->uploadOne($_FILES['imgFile']);  



    	//判断该文件夹在不在，如果不在则建立
    	// if(!is_dir($upload->savePath)){
    	// 	//路径  是否是自下级目录  
    	// 	mkdir($upload->savePath,0777,true);
    	// }

    	if(!$info) {
    		// 上传错误提示错误信息       
    	 	$this->ajaxReturn(array("error"=>1,"messages"=>$upload->getError()));    
    	 }else{
    	 	$url='/Uploads/'.$info['savepath'].$info['savename'];

    	 	//TP中的图片处理函数
    	 	$image = new \Think\Image(); 
    	 	$image->open($_SERVER['DOCUMENT_ROOT'].__ROOT__.$url);


    	 	//缩略图存放目录
    	 	// $thumb_url=__ROOT__.'/Uploads/'.$info['savepath'].'s_'.$info['savename'];
    	 	$thumb_url=__ROOT__.'/Uploads/'.$info['savepath'].$info['savename'];
    	 	$image->thumb(150,150,\Think\Image::IMAGE_THUMB_SCALE)->save($_SERVER['DOCUMENT_ROOT'].$thumb_url);
    	 	
    	 	// 上传成功        
    	 	$this->ajaxReturn(array("error"=>0,"url"=>$thumb_url));
         }



    }






    //这里将用面向对象的方法来进行更改状态
    public function changefield(){
            //总共传五个值过来 表名 主键名称  主键值  被修改的名称  被修改的值 

            $tableName=I("tableName");
            $primaryname=I("primaryname");//传过来的主键名称
            $primaryvalue=I("primaryvalue"); //传过来主键值
            $field=I('fieldname');//传过来的需要更改的列
            $field_value=I("fieldvalue");                        //传过来需要更改的值

            // echo $primaryvalue;die;
            // brandbrand_id01
            // echo $field.$field_value;die;

            $db=M($tableName); //需要传一张表过来

            $where[$primaryname]=$primaryvalue;

            //我这里做的只是更改一个字段的
            // getField('id,nickname,email');
            $b=$db->where($where)->setField($field,$field_value);

            // echo $db->getLastSql();die;

            if($b){
                $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
            }else{
                $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
            }


           




    }








}