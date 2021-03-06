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

    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="menu_add('添加菜单','<?php echo U("Weixin/weixin_menu_add");?>',500,330)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加菜单</a></span> <span class="r">共有数据：<strong id="TotalCount"></strong> 条</span> </div>
    <div class="mt-20">
        <table id='datatable' class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="185">菜单名称</th>
                <th width="185">上级目录</th>
                <th width="85">菜单类型</th>
                <th width="105">菜单标识</th>
                <th width="65">菜单状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/1.9.3/layer.js"></script>
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
            "url": "menu_datalist",
            "type": "POST",
            "data":{"pro_name":'sss'}
        },
        "columns": [
            {"bSortable": false, "data": "wm_id","mRender": function(data, type, full) {
                return '<input type="checkbox"   name="ids" value="' + data + '" >';
            }
            },
            { "data": "wm_name"},
            { "data": "wm_name"},
            { "data": "wm_type" },
            { "data": "wm_type_attr"},
            { "data": "wm_state","mRender": function(data, type, full) {
                if(data==1){
                    return '正常';
                }else{
                    return '禁用';
                }
            } },
            {"bSortable": false, "data": "wm_id", "mRender": function(data, type, full) {
                return '<a href ="/index.php/Admin/Weixin/DeleteAcceptanceProductData/id/'+data+'/flag/DeleteAcceptanceProductInfo"  class="ext_btn" onclick="return delSingle();"><span class="add"></span>删除</a>';
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
    /*微信-菜单-添加*/
    function menu_add(title,url,w,h){
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