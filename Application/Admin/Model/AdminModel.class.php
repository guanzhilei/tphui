<?php
/**
 * Created by PhpStorm.
 * User: SupGL
 * Date: 2016/3/24
 * Time: 15:20
 */
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{

    protected $_validate = array(
        array('username','require','管理员名称必须！'),
        array('username','','管理员名称已存在！',3,'unique',3),
    );
    protected $_auto = array(
        array('password','md5',3,'function'),
        array('state',1,1),
    );
}