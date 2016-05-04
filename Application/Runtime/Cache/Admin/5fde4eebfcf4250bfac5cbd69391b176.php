<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/Admin/lib/html5.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>栏目设置</title>
</head>
<body>
<div class="pd-20">
	<form action="<?php echo U('Product/product_brand_add');?>" method="post" class="form form-horizontal" id="form-category-add" enctype="multipart/form-data">
		<div id="tab-category" class="HuiTab">
			<div class="tabBar cl"><span>基本设置</span></div>
			<input type="hidden" name="brand_id" value="<?php echo ($signbrand["brand_id"]); ?>">
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>所属栏目：</label>
					<div class="formControls col-6"> <span class="select-box">
						<select class="select" id="sel_Sub" name="cat_id" onchange="SetSubID(this);" >
							<option value="0">所有分类</option>
							<?php if(is_array($catelist2)): foreach($catelist2 as $key=>$v): ?><option value="<?php echo ($v["cat_id"]); ?>" <?php if($signbrand["cat_id"] == $v['cat_id']): ?>selected<?php endif; ?>><?php echo (str_repeat('╞ ',$v["level"])); echo ($v["cat_name"]); ?></option><?php endforeach; endif; ?>
						</select>
						</span> </div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>品牌名称：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="<?php echo ($signbrand["brand_name"]); ?>" placeholder="" id="" name="brand_name" datatype="*" nullmsg="栏目名称不能为空">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>品牌缩略图：</label>
					<div class="formControls col-6"> 
							<div  style="width:150px;height:100px;overflow: hidden;">
					        <img id="thumb_url" src='<?php if($signbrand['brand_img']): echo ($signbrand["brand_img"]); else: ?>/Public/Admin//nopic.png<?php endif; ?>' >
					        </div>
					  	<input type="hidden"  id="picurl" name="brand_img" value="<?php echo ($signbrand["brand_img"]); ?>" datatype="*" nullmsg="图片不能为空"/> 
					  	<button class="btn btn-success" id="image"  type="button" >选择图片</button>
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3">排序：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="<?php echo ($signbrand["sort"]); ?>" placeholder="" id="" name="sort">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3">品牌描述：</label>
					<div class="formControls col-6" >
						<textarea name="brand_description"  datatype="*" nullmsg="描述不能为空"><?php echo ($signbrand["brand_description"]); ?></textarea>
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3">是否显示：</label>
					<div class="formControls col-6 skin-minimal">
						<div class="check-box">
							<input type="checkbox" name="is_show" id="checkbox-pinglun" value="1" <?php if($signbrand["is_show"] == 1): ?>checked<?php endif; ?>>
							<label for="checkbox-pinglun">&nbsp;</label>
						</div>
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
<script type="text/javascript" src="/Public/Admin/lib/layer/2.1/layer.js"></script> 
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
		ajaxPost:true,
		callback:function(data){
			if(data.status=='y'){
				setTimeout(function(){
					$.Hidemsg();
					var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
					parent.location.reload(); 
             				parent.layer.close(index); //执行关闭
				},2000)
			}
			
		}
	});
	$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
});

</script>

<!-- 新增编辑器引入文件 -->
<link rel="stylesheet" href="/Public/Admin/kindeditor/themes/default/default.css" />
<script src="/Public/Admin/kindeditor/kindeditor-min.js"></script>
<script src="/Public/Admin/kindeditor/lang/zh_CN.js"></script>
<script>
KindEditor.ready(function(K) {
	var editor = K.editor({
	    allowFileManager : true,
	    //这里因为我不知道在哪里       
	    uploadJson : "<?php echo U('Public/uploadImg',array('path'=>'brand'));?>", //上传功能
	    fileManagerJson : '/Public/Admin/kindeditor/php/file_manager_json.php?dirpath=brand', //网络空间
	  });  
	//上传背景图片
	K('#image').click(function() {
	  editor.loadPlugin('image', function() {
	    editor.plugin.imageDialog({
	    	//showRemote : false, //网络图片不开启
	    	//showLocal : false, //不开启本地图片上传
	     	imageUrl : K('#picurl').val(),
	        clickFn : function(url, title, width, height, border, align) {
	        K('#picurl').val(url);
	        $('#thumb_url').attr("src",url);
	        // $('#thumb_url').attr("width","200px");
	        editor.hideDialog();
	      }
	    });
	  });
	});
	
	var ed = K.create('textarea[name="brand_description"]', {
        resizeType : 1,
        uploadJson : "<?php echo U('Public/uploadImg',array('path'=>'brand'));?>",
        allowPreviewEmoticons : false,
        allowImageUpload : true,
        items : [
            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'multiimage','link'],
       afterBlur: function () { this.sync(); }
    });

	
});
</script> 
</body>
</html>