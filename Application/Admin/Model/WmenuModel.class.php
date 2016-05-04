<?php
/**
 * Created by PhpStorm.
 * User: SupGL
 * Date: 2016/3/24
 * Time: 15:20
 */
namespace Admin\Model;
use Think\Model;

class WmenuModel extends Model{

    protected $_validate = array(
        array('wm_name','require','菜单名称必须！'),
        array('wm_name','','菜单名称已存在！',3,'unique',3),
    );
    protected $_auto = array(
        array('wm_state',1,1),
    );
}