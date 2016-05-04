<?php
/*消息回复*/

namespace Admin\Controller;
use Think\Controller;
class BasicController extends Controller {

    public function text_response(){
        $this->display('text_response');
    }
    public function text_response_add(){
        $this->display('text_response_add');
    }



}