<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
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
<title>品牌管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 品牌管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">


	<form action="<?php echo U('Product/product_brand');?>" method="post"> 
		
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>所属栏目：</label>
			<div class="formControls col-3"> <span class="select-box">
				<select class="select" id="sel_Sub" name="cat_id" onchange="SetSubID(this);" >
					<option value="0">所有分类</option>
					<?php if(is_array($catelist2)): foreach($catelist2 as $key=>$v): ?><option value="<?php echo ($v["cat_id"]); ?>" <?php if($signbrand["cat_id"] == $v['cat_id']): ?>selected<?php endif; ?>><?php echo (str_repeat('╞ ',$v["level"])); echo ($v["cat_name"]); ?></option><?php endforeach; endif; ?>
				</select>
				</span> </div>

				<div class="text-c">
					<input type="text" name="content" id="" placeholder="品牌名称、ID、描述" style="width:250px" class="input-text">
					<input name="searchcontent" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</input>
				</div>
			
		</div>

		


	</form>
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="product_brand_add('添加资讯','<?php echo U('Product/product_brand_add');?>',600,400)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a></span> <span class="r">共有数据：<strong id="TotalCount"></strong> 条</span> </div>
	<div class="mt-20">
		<table id='datatable' class="table table-border table-bordered table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="70">ID</th>
					<th width="30">排序</th>
					<th width="200">图片</th>
					<th width="120">品牌名称</th>
					<th width="200">具体描述</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tfoot></tfoot>  
		</table>
	</div>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script><script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
var table = $('#datatable').dataTable({
	   "iDisplayLength" : 10, //默认显示的记录数  
	   "sPaginationType": "full_numbers",
	   'bFilter': true, //是否使用内置的过滤功能 
	   "aLengthMenu" : [10, 30, 50], //更改显示记录数选项  
	   "bServerSide": true, 
	    "bInfo" : true, //是否显示页脚信息，DataTables插件左下角显示记录数  
	   "bStateSave" : true,
       'bPaginate': true, //是否分页 
       "bProcessing": true,
	   "ajax": {  
           "url": "product_aaa", 
           "type": "POST",  
           "data":{"pro_name":'sss'},  
       },
        "columns": [ 
         {"sWidth": "10px","bSortable": false, "data": "brand_id","mRender": function(data, type, full) {  
                               return '<input type="checkbox"  id = "ids" name="ids" value="' + data + '" >';  
                           }  
                       },
        	 { "data": "brand_id"},
        	 { "data": "sort" },
        	  { "data": "brand_img" ,"bSortable": false},
        	   { "data": "brand_name" },
        	    { "data": "brand_description" },
        	     {"sWidth": "30px", "data": "brand_id", "mRender": function(data, type, full) {  
                               return '<a href ="/index.php/Admin/Product/DeleteAcceptanceProductData/id/'+data+'/flag/DeleteAcceptanceProductInfo"  class="ext_btn" onclick="return delSingle();"><span class="add"></span>删除</a>';  
                           }  
                       }
        ],
         "oLanguage": { //国际化配置  
                "sProcessing" : "正在获取数据，请稍后...",    
                "sLengthMenu" : "显示 _MENU_ 条",    
                "sZeroRecords" : "没有您要搜索的内容",    
                "sInfo" : "从 _START_ 到  _END_ 条记录 总记录数为 _TOTAL_ 条",    
                "sInfoEmpty" : "记录数为0",    
                "sInfoFiltered" : "(全部记录数 _MAX_ 条)",    
                "sInfoPostFix" : "",    
                "sSearch" : "搜索",    
                "sUrl" : "",    
                "oPaginate": {    
                    "sFirst" : "第一页",    
                    "sPrevious" : "上一页",    
                    "sNext" : "下一页",    
                    "sLast" : "最后一页"    
                }  
            }
});
table.on('xhr.dt', function (e, settings, json) {
$('#TotalCount').text(json.iTotalRecords);//读取总条数
});

function product_brand_add(title,url,w,h){
	
	layer_show(title,url,w,h);
}

/*这段JS才是完美的 如果不存在你TM的变成之前数据库里面排序的值啊，猪啊。 */
var values=0;
function getvalue(obj){
	values=obj.value;
	// alert(values);
}

function setvalue(obj,sort,id){
	var setv=obj.value;
	// alert(setv);
	if(isNaN(setv)){
		alert("请输入数字");
		obj.value=sort;
		return false;
	}

	$.post("<?php echo U('Public/changefield');?>",{tableName:"brand",primaryname:"brand_id",primaryvalue:id,fieldname:"sort",fieldvalue:setv},function(res){

			if(res.status=="y"){
				layer.msg('修改成功!', {icon: 6,time:1000});
				obj.value=setv;
			}else{
				layer.msg('修改失败!', {icon: 5,time:1000});
			}



		},'json');

}

/*这段JS才是完美的 */
/*管理员-停用*/
function admin_stop(obj,id){
	// alert(id);
	// alert(id);
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		

		$.post("<?php echo U('Public/changefield');?>",{tableName:"brand",primaryname:"brand_id",primaryvalue:id,fieldname:"is_show",fieldvalue:0},function(res){
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
	// alert(id);
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		// var a=id;
		
		$.post("<?php echo U('Public/changefield');?>",{tableName:"brand",primaryname:"brand_id",primaryvalue:id,fieldname:'is_show',fieldvalue:1},function(res){
				// alert(1);
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

//产品更改为什么我这里的宽高都设置不了啊，

function system_category_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}





/*系统-栏目-删除 数据删除了 但是没有刷新 */ 
function system_category_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		
		// alert(id);

		$.post("<?php echo U('Product/product_brand_del');?>",{"id":id,type:"one"},function(res){
			if(res.status=="y"){
				$(obj).parents("tr").remove();
				layer.msg("已删除",{icon:1,time:1000});
			}else{
					layer.msg('删除失败!',{icon:2,time:1000});
				}
		});
		
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

		$.post("<?php echo U('Product/product_brand_del');?>",{type:"all",id:id},function(res){
				if(res.status=="y"){
					$("input[name='check_id']:checked").parents("tr").remove();
					layer.msg('已删除!',{icon:1,time:1000});
				}else{
					layer.msg('删除失败!',{icon:2,time:1000});
				}
		});
	});
}



</script>
</body>
</html>