<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/23
 * Time: 23:14
 */
namespace Admin\Controller;
use Think\Controller;
use Vendor\Wechat\User;
use Vendor\Wechat\UserManage;


class WuserController extends Controller{
 //   protected $wmenuModel;
    public function _initialize(){
        //$this->wmenuModel = D('Wmenu');
    }
    function index(){

    }
    public function user_list(){
        $list = User::getFansList($next_openId='');
    //    $list=UserManage::getFansList($next_openId='');
        var_dump($list);
     //   var_dump($list['menu']['button']);
      //  $this->assign("menulist",$list['menu']['button']);
        $this->display('Wuser:weixin_user_list');
    }

    public function weixin_menu_add(){
        if(IS_POST){
            if(!$this->wmenuModel->create()){
                $this->ajaxReturn(array("status"=>"n","info"=>$this->wmenuModel->getError()));
            }else{
                $this->wmenuModel->wm_createtime=date("Y-m-d H:i:s");
                $rel = $this->wmenuModel->add();
            }
            if($rel){
                $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
            }else{
                $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
            }
        }else{
            $this->display('Weixin:weixin_menu_add');
        }
    }
}