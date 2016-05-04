<?php
//属于admin目录下面的控制器 也就是说来控制admin这个文件夹的

namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

	//入口加载方法 默认登录界面
    public function index(){	
    	 //视图名+页面名

        if(!session('?tpadminuser')){
             // $this->display("Index/login"); //默认本控制器下面的界面  也就是说是Index文件夹下面
             //这里用重定向

            $this->redirect("Index/login");
        }else{
            $this->display("Main/index");//测试 正确
        }


    
       
    }
    //这是登录界面
    public function login(){
    	if(IS_POST){
    		$username=I('username');
    		$password=I('password');
    		$checkcode=I('checkcode');

    		$db=M("admin");
    		$list=$db->where("username='$username'")->find();

    		//输出SQL语句
    		// echo $db->getLastSql();die;

    		// echo $list['username'];die;

    		// var_dump($list);die;   

            //验证验证码
            // $checkcode = I('checkcode');

            // $verify = new \Think\Verify();
            // $codeV=$verify->check($checkcode, $id);
            // if(!$codeV){
            //      $this->error('codeError');die;
            // }
            

    		$password=md5($password);
    		if($list['password']!=$password){
    			// die("<script>alert('0000');history.back();</script>");
    			 $this->error('loginerror');die;//error 界面展示
    			
    		}

            //在这里做判断是否第一次登录和是否第一次登录
            $list['logintime']=($list['logintime']==0)?"首次登录":date("Y-m-d H:s:i",$list['logintime']);
            $list['login_num']=($list['login_num']==0)?"第一次登录":$list['login_num'];
            //设置session
            session('tpadminuser',$list);  
           
            //修改登录时间 和登录次数
            $where['id']=$list['id'];
            $datas['login_num']=$list['login_num']+1;
            $datas['logintime']=time();
            $db->where($where)->save($datas);

            
    		// echo "<script>alert('loginsuccess');</script>";
    		$this->display("main/index");
    		
    	}else{
    		$this->display("index/login");
    	}

    }

    //	//m =模板  c=控制器 a=页面(操作或者方法)  地址拼接在这里
    //  public function home(){
    // 	$this->display("Main/index");
    // }

    //验证码
    public function verifys(){
    	$config =    array(    'fontSize'    =>    30,    // 验证码字体大小    
    	'length'      =>    3,     // 验证码位数    
    	'useNoise'    =>    false, // 关闭验证码杂点
    	);
    	$Verify =new \Think\Verify($config);
    	$Verify->entry();
    }


}