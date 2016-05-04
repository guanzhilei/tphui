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
	<form action="<?php echo U('System/system_category_add');?>" method="post" class="form form-horizontal" id="form-category-add">
		<div id="tab-category" class="HuiTab">
			<div class="tabBar cl"><span>基本设置</span><span>模版设置</span><span>SEO</span></div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-3">栏目ID：</label>
					<div class="formControls col-6"><?php echo ($signcate["cat_id"]); ?></div>

					<input name="cat_id" type="text" value="<?php echo ($signcate["cat_id"]); ?>" />
				</div>
				<div class="row cl">
					<label class="form-label col-3"><span class="pid">*</span>上级栏目：</label>
					<div class="formControls col-6"> <span class="select-box">
						<select class="select" id="sel_Sub" name="pid" onchange="SetSubID(this);">
							<option value="0">顶级分类</option>
							<!--选定某个值-->
							<?php if(is_array($arr)): foreach($arr as $key=>$v): ?><option value="<?php echo ($v["cat_id"]); ?>" 
									<?php if($v["cat_id"] == $signcate['pid']): ?>selected<?php endif; ?>
								>
								<?php echo (str_repeat('┠',$v["level"])); echo ($v["cat_name"]); ?>
								</option><?php endforeach; endif; ?>
						</select>
						</span> </div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>栏目名称：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="<?php echo ($signcate["cat_name"]); ?>" placeholder="" id="" name="cat_name" datatype="*2-16" nullmsg="用户名不能为空">
					</div>
					<div class="col-3"> </div>
				</div>
				
				<!--选择类型的代码-->
				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>类型名称：</label>
					<div class="formControls col-6">
						<select name="type_id">
							<option value="0">所有分类</option>
							<?php if(is_array($typelist)): foreach($typelist as $key=>$k): ?><option value="<?php echo ($k["type_id"]); ?>" 
										
										<?php if($k["type_id"] == $signcate['type_id']): ?>selected<?php endif; ?>
								


									><?php echo ($k[type_name]); ?></option><?php endforeach; endif; ?>	
						</select>	

						
					</div>
					<div class="col-3"> </div>
				</div>


				<div class="row cl">
					<label class="form-label col-3">是否显示:</label>
					<div class="formControls col-1">
						<input type="checkbox" class="input-text" value="1" placeholder="" id="" name="is_show" 
							<?php if($signcate["is_show"] == 1): ?>checked<?php endif; ?>
						>	
					</div>
					<div class="col-3"> </div>
				</div>


				<!--修改的状态-->
				<!-- <div class="row cl">
					<label class="form-label col-3">当前状态：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="" placeholder="" id="" name="statu">
					</div>
					<div class="col-3"> </div>
				</div> -->
				
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