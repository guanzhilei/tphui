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
<link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>栏目管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 栏目管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20 text-c">
	<div class="text-c">
		<input type="text" name="" id="" placeholder="栏目名称、id" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="system_category_add('添加资讯','<?php echo U('System/system_category_add');?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th width="80">栏目名称</th>
					<th width="80">父级名称</th>
					<th width="80">是否显示</th>
					
					<th width="80">类型</th>
					<th width="80">排序</th>
					<th width="100">是否已启用</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($arr)): foreach($arr as $key=>$v): ?><tr class="text-c" id="tr<?php echo ($v["cat_id"]); ?>">
						<td><input type="checkbox" name="check_id" value="<?php echo ($v["cat_id"]); ?>"></td>
						<td><?php echo ($v["cat_id"]); ?></td>
						<td class="text-l"><?php echo (str_repeat('┠',$v["level"])); echo ($v["cat_name"]); ?></td>
						<td><?php echo (getNameBytypeCatId($v["pid"])); ?></td>
						<td><?php echo ($v["statu"]); ?></td>
						
						<!-- <td><?php echo (getNameBytypeId($v["type_id"])); ?></td> -->
						<td><?php echo (getNameBytypePid("type",$v["type_id"],"type_name")); ?></td>
						<td><?php echo ($v["sort"]); ?></td>	
						<!-- <td><?php echo ($v["is_show"]); ?> 用它来做状态是否启用</td> -->
						<?php if($v["is_show"] == 1): ?><td class="td-status"><span class="label label-success radius">已启用</span></td>
							<?php else: ?>
							<td class="td-status"><span class="label label-error radius">已禁用</span></td><?php endif; ?>
									

									
						<td class="td-manage">
							
							<?php if($v["is_show"] == 1): ?><a style="text-decoration:none" onClick="admin_stop(this,<?php echo ($v["cat_id"]); ?>)" href="javascript:;" title="停用">
								<i class="Hui-iconfont">&#xe631;</i></a> 

								<?php else: ?>
 
								<a style="text-decoration:none" onClick="admin_start(this,<?php echo ($v["cat_id"]); ?>)" href="javascript:;" title="启用">
								<i class="Hui-iconfont">&#xe631;</i></a><?php endif; ?>	

							
							

							<a title="编辑" href="javascript:;" onclick="system_category_edit('栏目编辑','<?php echo U('System/system_category_add',array("cat_id"=>"$v[cat_id]"));?>','1','700','480')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="system_category_del(this,<?php echo ($v['cat_id']); ?>)"  class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
							</td>
					</tr><?php endforeach; endif; ?>
				
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$('.table-sort').dataTable({
	"iDisplayLength": 2,//每页显示10条数据
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	//"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
	]
});
/*系统-栏目-添加*/
function system_category_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-编辑*/
function system_category_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-删除 数据删除了 但是没有刷新 */ 
function system_category_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		
		// alert(id);

		$.post("<?php echo U('System/system_category_del');?>",{"id":id,type:"one"},function(res){
			if(res.status=="y"){
				$(obj).parents("tr").remove();
				for(var i=0;i<res.arr_id.length;i++){
					$("#tr"+res.arr_id[i]).remove();
				}
				layer.msg("已删除",{icon:1,time:1000});
			}else{
					layer.msg('删除失败!',{icon:2,time:1000});
				}
		},"json");
		
	});
}




/*批量删除  已经搞定 但单个删除有问题啊 意思就是说页面没有刷新， 懂？ */  
function datadel(){
	layer.confirm("确定要删除吗？",function(index){
		//这里储存需要被删除的所有的ID 

		var id="";
		var str_id=$("input[name='check_id']");

		for(var i =0;i<str_id.length;i++){
			if(str_id[i].checked){
				id+=str_id[i].value+",";
			}
		}
		// alert(id);

		if(id==""){
			layer.msg("没有数据",{icon:5,time:1000});
			return false;
		}

		$.post("<?php echo U('System/system_category_del');?>",{type:"all",id:id},function(res){
				if(res.status=="y"){
					$("input[name='check_id']:checked").parents("tr").remove();
					for(var i=0;i<res.arr_id.length;i++){
						$("#tr"+res.arr_id[i]).remove();
					}


					layer.msg('已删除!',{icon:1,time:1000});
				}else{
					layer.msg('删除失败!',{icon:2,time:1000});
				}
		},"json");
	});
}




/*管理员-停用*/
function admin_stop(obj,id){
	// alert(id);
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		

		$.post("<?php echo U('System/system_category_changestatu');?>",{id:id,type:"stop"},function(res){
				if(res.status=="y"){
					$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,'+id+')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-error radius">已禁用</span>');
				$(obj).remove();
				layer.msg('已停用!',{icon: 5,time:1000});
				}else{
					layer.msg('修改失败!', {icon: 5,time:1000});
				}
		},'json');


	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		$.post("<?php echo U('System/system_category_changestatu');?>",{id:id,type:"start"},function(res){

				if(res.status=="y"){

					$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,'+id+')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
					$(obj).remove();
					layer.msg('已启用!', {icon: 6,time:1000});
				}else{
					layer.msg('修改失败!', {icon: 5,time:1000});
				}
		},'json');

	});
}
</script>
</body>
</html>