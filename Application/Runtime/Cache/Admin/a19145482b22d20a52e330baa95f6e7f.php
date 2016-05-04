<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,member-scalable=no" />
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
<title>栏目设置</title>
</head>
<body>
<div class="pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-category-add">
		<div id="tab-category" class="HuiTab">
			<div class="tabBar cl"><span>基本设置</span><span>模版设置</span><span>SEO</span></div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-3">类型ID：</label>
					<div class="formControls col-6">11230</div>
				</div>
				
				
				<!--隐藏域 隐藏ID-->
				<input value="<?php echo ($list["type_id"]); ?>" type="hidden" name="type_id"/>

				<div class="row cl">
					<label class="form-label col-3">类型名称：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="<?php echo ($list["type_name"]); ?>" placeholder="" id="" name="type_name">
					</div>
					<div class="col-3"> </div>
				</div>
				
				
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-3">首页模版：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="" style="width:200px;">
						<input type="button" class="btn btn-default" value="浏览">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3">列表页模版：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="" style="width:200px;">
						<input type="button" class="btn btn-default" value="浏览">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3">详情页模版：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="" style="width:200px;">
						<input type="button" class="btn btn-default" value="浏览">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3">详细页存储规则：</label>
					<div class="formControls col-6"> <span class="select-box">
						<select class="select" id="" name="">
							<option value="1">按年度划子目录</option>
							<option value="2">按年/月划分子目录</option>
							<option value="3">按年/月/日划分子目录</option>
						</select>
						</span> </div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3">每页显示多少条：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="20" style="width:200px;">
					</div>
					<div class="col-3"> </div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-3">首页文件名：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="index.html" style="width:200px;">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3">关键词：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3">描述：</label>
					<div class="formControls col-6">
						<textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"></textarea>
						<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
					</div>
					<div class="col-3"> </div>
				</div>
			</div>
		</div>
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</div>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script> 
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-category-add").Validform({
		tiptype:2,
		ajaxPost:true, //是否使用ajaxpost方式提交
		callback:function(data){
			//alert(form); 我这里直接输出了一个1 
 			if(data.status=='y'){
 				// alert(data.status);
 				setTimeout(function(){
 					$.Hidemsg();//这是什么鬼？
 					//form[0].submit();
					var index = parent.layer.getFrameIndex(window.name);//获得当前窗体索引
					//parent.$('.btn-refresh').click();
					parent.location.reload();	
					parent.layer.close(index);//执行关闭
 				},1000);
 			}
		}
	});
	$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
});
</script>
</body>
</html>