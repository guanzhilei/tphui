<?php
//属于admin目录下面的控制器 也就是说来控制admin这个文件夹的

namespace Admin\Controller;
use Think\Controller;
class MainController extends Controller {

	//入口加载方法 默认登录界面
    public function index(){	
    	 //视图名+页面名
      $this->display("main/index"); //默认本控制器下面的界面  也就是说是Index文件夹下面
       // $this->display("Main/index");//测试 正确
    }
    
    public function welcome(){
        $this->display("main/welcome");
    }

    //退出方法

    public function exits(){
        // 使session失效
        session("tpadminuser",null);
        $this->display("index/login");
    }
}