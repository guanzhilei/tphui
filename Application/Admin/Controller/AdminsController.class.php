<?php
//属于Admin目录下面的控制器 也就是说来控制admin这个文件夹的 application 下面的命名空间 猪唉

namespace Admin\Controller;
use Think\Controller;
class AdminsController extends PublicController {

    //入口加载方法 默认登录界面
    // public function index(){	
    // 	 //视图名+页面名
    //   //$this->display("Admins/admin_list"); //默认本控制器下面的界面  也就是说是Index文件夹下面
    //    // $this->display("Main/index");//测试 正确
    // }

    // public function admin_list(){
    //   $this->display("Admins/admin_list");
    // }
    protected $adminModel;
    public function _initialize(){
        $this->adminModel = D('Admin');
    }

    public function admin_list(){
        $where = 'id <> ""';
        $_POST['datemin']?$where.=" AND firsttime>={$_POST['datemin']}":'';
        $_POST['datemax']?$where.=" AND firsttime<={$_POST['datemax']}":'';
        $_POST['username']?$where.=" AND username like '%{$_POST['username']}%'":'';
        $list = $this->adminModel->where($where)->select();
        $listcount = $this->adminModel->where($where)->count();
        $this->assign("search",$_POST);
        $this->assign("list",$list);
        $this->assign("listcount",$listcount);
        $this->display("Admins/admin_list");
    }

    public function admin_del(){
        $id=trim(I('id',0),',');
        $rel = $this->adminModel->delete($id);
        if($rel){
            $this->ajaxReturn(array("status"=>"y","info"=>"删除成功"));
        }else{
            $this->ajaxReturn(array("status"=>"n","info"=>"删除失败"));
        }
    }

    public function admin_add(){
        $id=I('id',0);
        if(IS_POST){
            if($id){
                $rel = $this->adminModel->save($_POST);
            }else{
                if(!$this->adminModel->create()){
                    $this->ajaxReturn(array("status"=>"n","info"=>$this->adminModel->getError()));
                }else{
                    $this->adminModel->firsttime=date("Y-m-d");
                    $rel = $this->adminModel->add();
                }
            }
            if($rel){
                $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
            }else{
                $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
            }
        }else{
            if($id){
                $editrow = $this->adminModel->where(array('id'=>$id))->find();
                $this->assign("editrow",$editrow);
            }
            $this->display("Admins/admin_add");
        }
    }

    public function admin_permission(){
        $this->display("Admins/admin_permission");
    }

    public function admin_role(){
        $this->display("Admins/admin_role");
    }

    public function admin_role_add(){
        $this->display("Admins/admin_role_add");
    }


}