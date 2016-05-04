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

    <form action="<?php echo U('System/system_type');?>" method="post">
        <div class="text-c">
            <input type="text" name="searchcontent" id="" placeholder="栏目名称、id" style="width:250px" class="input-text">
            <input name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</input>
        </div>
    </form>

    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="system_category_add('添加资讯','<?php echo U("System/system_type_add");?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a></span> <span class="r">共有数据：<strong><?php echo (count($typelist)); ?></strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>

                <th>栏目名称</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($typelist)): foreach($typelist as $key=>$v): ?><tr class="text-c">
                    <td><input type="checkbox" name="check_id" value="<?php echo ($v["type_id"]); ?>"></td>

                    <td><?php echo ($v["type_id"]); ?></td>
                    <td><?php echo ($v["type_name"]); ?></td>
                    <td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('栏目编辑','<?php echo U('System/system_type_add',array("type_id"=>"$v[type_id]"));?>','1','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="system_category_del(this,<?php echo ($v[type_id]); ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr><?php endforeach; endif; ?>

            </tbody>
        </table>
    </div>
</div>

<style type="text/css">
    #pages{width:1200px;margin:20px auto;text-align: center;}
    #pages a,#pages span{display:inline-block;width:50px;height:30px;margin:10px;background: #ccc;line-height:30px;}
    #pages .current{background:#888;}
</style>



<div id="pages"><?php echo ($page); ?></div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
<!-- <script type="text/javascript" src="/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>  -->
<script type="text/javascript" src="/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    // $('.table-sort').dataTable({
    // 	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
    // 	"bStateSave": true,//状态保存
    // 	"aoColumnDefs": [
    // 	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
    // 	  {"orderable":false,"aTargets":[0,1]}// 制定列不参与排序
    // 	]
    // });
    /*系统-栏目-添加*/
    function system_category_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*系统-栏目-编辑*/
    function system_category_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*系统-栏目-删除*/
    function system_category_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){

            $.post("<?php echo U('System/system_type_del');?>",{"type_id":id,type:"one"},function(res){

                if(res.status=="y"){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }else{
                    layer.msg('删除失败!',{icon:2,time:1000});
                }
            });
        });
    }


    /*批量删除*/
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


            if(id==""){
                layer.msg("没有数据",{icon:5,time:1000});
                return false;
            }

            $.post("<?php echo U('System/system_type_del');?>",{type:"all",type_id:id},function(res){
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