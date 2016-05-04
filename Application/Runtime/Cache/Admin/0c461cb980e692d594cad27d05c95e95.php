<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <script type="text/javascript" src="lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>添加菜单</title>
</head>
<body>
<div class="pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-weixin-menu-add">
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>菜单名称：</label>
            <div class="formControls col-8">
                <input type="hidden" name="wm_id" value="">
                <input type="text" class="input-text"  placeholder="" id="wm_name" name="wm_name" datatype="*1-7" nullmsg="菜单名称不能为空">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3">上级目录：</label>
            <div class="formControls col-8">
                <span class="select-box">
                  <select class="select" size="1" name="wm_pic" id="wm_pic">
                      <option value="" selected>一级目录</option>
                      <option value="click">点击推事件</option>
                      <option value="view">跳转URL</option>
                      <option value="scancode_push">扫码推事件</option>
                  </select>
                </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>类型：</label>
            <div class="formControls col-8">
                <span class="select-box">
                  <select class="select" size="1" name="wm_type" id="wm_type">
                      <option value="" selected>默认select</option>
                      <option value="click">点击推事件</option>
                      <option value="view">跳转URL</option>
                      <option value="scancode_push">扫码推事件</option>
                      <option value="scancode_waitmsg">扫码推事件且弹出“消息接收中”提示框</option>
                      <option value="pic_sysphoto">弹出系统拍照发图</option>
                      <option value="pic_photo_or_album">弹出拍照或者相册发图</option>
                      <option value="pic_weixin">弹出微信相册发图器</option>
                      <option value="location_select">弹出地理位置选择器</option>
                      <option value="media_id">下发消息（除文本消息）</option>
                      <option value="view_limited">跳转图文消息URL</option>
                  </select>
                </span>
            </div>
        </div>
        <div class="row cl" id="wtype">

        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    $(function(){
        $('#wm_type').change(function(){
            var value = $(this).val();
            if(value=='click'){
                $('#wtype').html('<label class="form-label col-3"><span class="c-red">*</span>Key：</label> ' +
                '<div class="formControls col-8"> ' +
                '<input type="text" class="input-text"  placeholder="key"  name="wm_type_attr" datatype="*2-26" nullmsg="不能为空"> ' +
                '</div>');
            }else if(value=='view'){
                $('#wtype').html('<label class="form-label col-3"><span class="c-red">*</span>Url：</label> ' +
                '<div class="formControls col-8"> ' +
                '<input type="text" class="input-text"  placeholder="url"  name="wm_type_attr" datatype="url" nullmsg="填写url地址"> ' +
                '</div>');
            }else if(value=='media_id' || value=='view_limited'){
                $('#wtype').html('<label class="form-label col-3"><span class="c-red">*</span>Media_id：</label> ' +
                '<div class="formControls col-8"> ' +
                '<input type="text" class="input-text"  placeholder="Media_id"  name="wm_type_attr" datatype="*2-26" nullmsg="不能为空"> ' +
                '</div>');
            }
        })
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-weixin-menu-add").Validform({
            tiptype:2,
            ajaxPost:true, //是否使用ajaxpost方式提交
            callback:function(data){
                if(data.status=='y'){
                    setTimeout(function(){
                        var index = parent.layer.getFrameIndex(window.name);//获得当前窗体索引
                        parent.location.reload();
                        parent.layer.close(index);//执行关闭
                    },1000);
                }
            }
        });
    });
</script>
</body>
</html>