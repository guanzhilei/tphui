<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/23
 * Time: 23:14
 */
namespace Admin\Controller;
use Think\Controller;
use Vendor\Wechat\Menu;
use Ventor\Wechat\Wechat;

class WeixinController extends Controller{
    protected $wmenuModel;
    public function _initialize(){
        $this->wmenuModel = D('Wmenu');
    }
    function index(){
        $wechat = new \Vendor\Wechat\Wechat('qbtest', TRUE);
        //首次使用需要注视掉下面这1行（26行），并打开最后一行（29行）
        echo $wechat->run();
        //首次使用需要打开下面这一行（29行），并且注释掉上面1行（26行）。本行用来验证URL
        // $wechat->checkSignature();
    }
    public function menu_datalist(){
        $start = I('start');
        $limit = I('length');
        $iorder = (I('order'));
        $icolumn = (I('columns'));
        $order=array($icolumn[$iorder[0]['column']]['data']=>$iorder[0]['dir']);
        $isearch = I('search');
        $isearch['value']?$where="`BRAND_NAME` like '%$isearch[value]%'":$where='';
        $list=$this->wmenuModel->where($where)->limit($start,$limit)->order($order)->select();
        $num =$this->wmenuModel->where($where)->count();
        $num==0?$list=array():'';
        $data = array(
            'iTotalRecords' => $num,//数据的总条数
            'iTotalDisplayRecords' => $num,//显示的条数
            'aaData' => $list //此处为我们的list数据也就是从数据库中取出来的了
        );
        echo json_encode($data);
    }
    public function menu_list(){
        $list=Menu::getMenu();
        var_dump($list['menu']['button']);
        $this->assign("menulist",$list['menu']['button']);
        $this->display('Weixin:weixin_menu_list');
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
//                $one_click_menu = array(
//                    'type'=>$_POST['wm_type'],
//                    'name'=>$_POST['wm_name'],
//                    'code'=>$_POST['wm_type_attr'],
//                );
//                $menu['button']=$one_click_menu;
//                Menu::setMenu($menu);
                $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
            }else{
                $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
            }
        }else{
            $this->display('Weixin:weixin_menu_add');
        }
//        if(IS_POST){
//            $one_click_menu = array(
//                'type'=>$_POST['type'],
//                'name'=>$_POST['name'],
//                'key'=>$_POST['key'],
//            );
//            $menu['button']=$one_click_menu;
//         //   print_r(json_encode($menu));
//            Menu::setMenu($menu);
//        }
//        $this->display('Weixin:weixin_menu_add');
    }
}