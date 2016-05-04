/* -----------H-ui前端框架-------------
 * H-ui.admin.js v2.4
 * http://www.h-ui.net/
 * Created & Modified by guojunhui
 * Date modified 15:42 2016.03.14
 *
 * Copyright 2013-2016 北京颖杰联创科技有限公司 All rights reserved.
 * Licensed under MIT license.
 * http://opensource.org/licenses/MIT
 *
 */
var num=0,oUl=$("#min_title_list"),hide_nav=$("#Hui-tabNav");

/*获取顶部选项卡总长度*/
function tabNavallwidth(){
    var taballwidth=0,
        $tabNav = hide_nav.find(".acrossTab"),
        $tabNavWp = hide_nav.find(".Hui-tabNav-wp"),
        $tabNavitem = hide_nav.find(".acrossTab li"),
        $tabNavmore =hide_nav.find(".Hui-tabNav-more");
    if (!$tabNav[0]){return}
    $tabNavitem.each(function(index, element) {
        taballwidth+=Number(parseFloat($(this).width()+60))
    });
    $tabNav.width(taballwidth+25);
    var w = $tabNavWp.width();
    if(taballwidth+25>w){
        $tabNavmore.show()}
    else{
        $tabNavmore.hide();
        $tabNav.css({left:0})
    }
}

/*左侧菜单响应式*/
function Huiasidedisplay(){
    if($(window).width()>=768){
        $(".Hui-aside").show()
    }
}
function getskincookie(){
    var v = getCookie("Huiskin");
    var hrefStr=$("#skin").attr("href");
    if(v==null||v==""){
        v="default";
    }
    if(hrefStr!=undefined){
        var hrefRes=hrefStr.substring(0,hrefStr.lastIndexOf('skin/'))+'skin/'+v+'/skin.css';
        $("#skin").attr("href",hrefRes);
    }
}
function Hui_admin_tab(obj){
    if($(obj).attr('_href')){
        var bStop=false;
        var bStopIndex=0;
        var _href=$(obj).attr('_href');
        var _titleName=$(obj).attr("data-title");
        var topWindow=$(window.parent.document);
        var show_navLi=topWindow.find("#min_title_list li");
        show_navLi.each(function() {
            if($(this).find('span').attr("data-href")==_href){
                bStop=true;
                bStopIndex=show_navLi.index($(this));
                return false;
            }
        });
        if(!bStop){
            creatIframe(_href,_titleName);
            min_titleList();
        }
        else{
            show_navLi.removeClass("active").eq(bStopIndex).addClass("active");
            var iframe_box=topWindow.find("#iframe_box");
            iframe_box.find(".show_iframe").hide().eq(bStopIndex).show().find("iframe").attr("src",_href);
        }
    }

}
function min_titleList(){
    var topWindow=$(window.parent.document);
    var show_nav=topWindow.find("#min_title_list");
    var aLi=show_nav.find("li");
};
function creatIframe(href,titleName){
    var topWindow=$(window.parent.document);
    var show_nav=topWindow.find('#min_title_list');
    show_nav.find('li').removeClass("active");
    var iframe_box=topWindow.find('#iframe_box');
    show_nav.append('<li class="active"><span data-href="'+href+'">'+titleName+'</span><i></i><em></em></li>');
    var taballwidth=0,
        $tabNav = topWindow.find(".acrossTab"),
        $tabNavWp = topWindow.find(".Hui-tabNav-wp"),
        $tabNavitem = topWindow.find(".acrossTab li"),
        $tabNavmore =topWindow.find(".Hui-tabNav-more");
    if (!$tabNav[0]){return}
    $tabNavitem.each(function(index, element) {
        taballwidth+=Number(parseFloat($(this).width()+60))
    });
    $tabNav.width(taballwidth+25);
    var w = $tabNavWp.width();
    if(taballwidth+25>w){
        $tabNavmore.show()}
    else{
        $tabNavmore.hide();
        $tabNav.css({left:0})
    }
    var iframeBox=iframe_box.find('.show_iframe');
    iframeBox.hide();
    iframe_box.append('<div class="show_iframe"><div class="loading"></div><iframe frameborder="0" src='+href+'></iframe></div>');
    var showBox=iframe_box.find('.show_iframe:visible');
    showBox.find('iframe').load(function(){
        showBox.find('.loading').hide();
    });
}
function removeIframe(){
    var topWindow = $(window.parent.document);
    var iframe = topWindow.find('#iframe_box .show_iframe');
    var tab = topWindow.find(".acrossTab li");
    var showTab = topWindow.find(".acrossTab li.active");
    var showBox=topWindow.find('.show_iframe:visible');
    var i = showTab.index();
    tab.eq(i-1).addClass("active");
    iframe.eq(i-1).show();
    tab.eq(i).remove();
    iframe.eq(i).remove();
}
/*弹出层*/
/*
 参数解释：
 title	标题
 url		请求的url
 id		需要操作的数据id
 w		弹出层宽度（缺省调默认值）
 h		弹出层高度（缺省调默认值）
 */
function layer_show(title,url,w,h){
    if (title == null || title == '') {
        title=false;
    };
    if (url == null || url == '') {
        url="404.html";
    };
    if (w == null || w == '') {
        w=800;
    };
    if (h == null || h == '') {
        h=($(window).height() - 50);
    };
    layer.open({
        type: 2,
        area: [w+'px', h +'px'],
        fix: false, //不固定
        maxmin: true,
        shade:0.4,
        title: title,
        content: url
    });
}
/*关闭弹出框口*/
function layer_close(){
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);
}

$(function(){
    getskincookie();
    //layer.config({extend: 'extend/layer.ext.js'});
    Huiasidedisplay();
    var resizeID;
    $(window).resize(function(){
        clearTimeout(resizeID);
        resizeID = setTimeout(function(){
            Huiasidedisplay();
        },500);
    });

    $(".nav-toggle").click(function(){
        $(".Hui-aside").slideToggle();
    });
    $(".Hui-aside").on("click",".menu_dropdown dd li a",function(){
        if($(window).width()<768){
            $(".Hui-aside").slideToggle();
        }
    });
    /*左侧菜单*/
    $.Huifold(".menu_dropdown dl dt",".menu_dropdown dl dd","fast",1,"click");
    /*选项卡导航*/

    $(".Hui-aside").on("click",".menu_dropdown a",function(){
        Hui_admin_tab(this);
    });
    $(".Hui-aside").on("click",".menu_dropdown_no a",function(){
        Hui_admin_tab(this);
    });

    $(document).on("click","#min_title_list li",function(){
        var bStopIndex=$(this).index();
        var iframe_box=$("#iframe_box");
        $("#min_title_list li").removeClass("active").eq(bStopIndex).addClass("active");
        iframe_box.find(".show_iframe").hide().eq(bStopIndex).show();
    });
    $(document).on("click","#min_title_list li i",function(){
        var aCloseIndex=$(this).parents("li").index();
        $(this).parent().remove();
        $('#iframe_box').find('.show_iframe').eq(aCloseIndex).remove();
        num==0?num=0:num--;
        tabNavallwidth();
    });
    $(document).on("dblclick","#min_title_list li",function(){
        var aCloseIndex=$(this).index();
        var iframe_box=$("#iframe_box");
        if(aCloseIndex>0){
            $(this).remove();
            $('#iframe_box').find('.show_iframe').eq(aCloseIndex).remove();
            num==0?num=0:num--;
            $("#min_title_list li").removeClass("active").eq(aCloseIndex-1).addClass("active");
            iframe_box.find(".show_iframe").hide().eq(aCloseIndex-1).show();
            tabNavallwidth();
        }else{
            return false;
        }
    });
    tabNavallwidth();

    $('#js-tabNav-next').click(function(){
        num==oUl.find('li').length-1?num=oUl.find('li').length-1:num++;
        toNavPos();
    });
    $('#js-tabNav-prev').click(function(){
        num==0?num=0:num--;
        toNavPos();
    });

    function toNavPos(){
        oUl.stop().animate({'left':-num*100},100);
    }

    /*换肤*/
    $("#Hui-skin .dropDown-menu a").click(function(){
        var v = $(this).attr("data-val");
        setCookie("Huiskin", v);
        var hrefStr=$("#skin").attr("href");
        var hrefRes=hrefStr.substring(0,hrefStr.lastIndexOf('skin/'))+'skin/'+v+'/skin.css';

        $(window.frames.document).contents().find("#skin").attr("href",hrefRes);
        //$("#skin").attr("href",hrefResd);
    });
});
/*新增tab页面保存后关闭跳转到主页面
* @title string  tab名称
* */
function addtabRemove(title){
    var topWindow = $(window.parent.document);
    var toptab = topWindow.find('.acrossTab li.active i');
    toptab.parent().remove();
    var aCloseIndex=toptab.parents("li").index();
    $(topWindow.find('.acrossTab li')).each(function(){
        if($(this).find('span').html()==title){
            var url = $(this).find('span').attr('data-href');
            var htmlstr = '<a data-title="'+title+'" _href="'+url+'" href="javascript:void(0)">'+title+'</a>';
            Hui_admin_tab(htmlstr);
            topWindow.find('#iframe_box .show_iframe').eq(aCloseIndex).remove();
        }
    });
}
/*显示多的内容*/
function showtextiframe(title,url){
    layer.open({
        type: 2,
        title: title,
        shadeClose: true,
        shade: 0.3,
        area: ['680px', '60%'],
        content: url
    });
}
/*
 @contactid html页面关联id
 @thumwidth 缩略图宽度，默认100
 @thumheight 缩略图高度，默认100
 @maxnum 最多上传数量，默认30
 @editid 修改时ID，默认空
 @editdata 修改时图片数据[{id:int,name:string,state:ready}]，默认空
 @buttontext 按钮名称 string，默认‘点击选择图片’
 */
function ypt_webupload(contactid){
    var thumwidth=arguments[1]?arguments[1]:100;
    var thumheight=arguments[2]?arguments[2]:100;
    var maxnum=arguments[3]?arguments[3]:30;
    var editid=arguments[4]?arguments[4]:'';
    var editdata=arguments[5]?eval('('+ arguments[5] +')'):'';
    var buttontext=arguments[6]?arguments[6]:'点击选择图片';
    // 当domReady的时候开始初始化
    var $wrap = $('.uploader-list-container'),

    // 图片容器
        $queue = $( '<ul class="filelist"></ul>' )
            .appendTo( $wrap.find( '.queueList' ) ),

    // 状态栏，包括进度和控制按钮
        $statusBar = $wrap.find( '.statusBar' ),

    // 文件总体选择信息。
        $info = $statusBar.find( '.info' ),

    // 上传按钮
        $upload = $wrap.find( '.uploadBtn' ),

    // 没选择文件之前的内容。
        $placeHolder = $wrap.find( '.placeholder' ),

        $progress = $statusBar.find( '.progress' ).hide(),

    // 添加的文件数量
        fileCount = 0,

    // 添加的文件总大小
        fileSize = 0,

    // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

    // 缩略图大小
        thumbnailWidth = thumwidth * ratio,
        thumbnailHeight = thumheight * ratio,

    // 可能有pedding, ready, uploading, confirm, done.
        state = 'pedding',

    // 所有文件的进度信息，key为file id
        percentages = {},
    // 判断浏览器是否支持图片的base64
        isSupportBase64 = ( function() {
            var data = new Image();
            var support = true;
            data.onload = data.onerror = function() {
                if( this.width != 1 || this.height != 1 ) {
                    support = false;
                }
            }
            data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
            return support;
        } )(),

    // 检测是否已经安装flash，检测flash的版本
        flashVersion = ( function() {
            var version;

            try {
                version = navigator.plugins[ 'Shockwave Flash' ];
                version = version.description;
            } catch ( ex ) {
                try {
                    version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
                        .GetVariable('$version');
                } catch ( ex2 ) {
                    version = '0.0';
                }
            }
            version = version.match( /\d+/g );
            return parseFloat( version[ 0 ] + '.' + version[ 1 ], 10 );
        } )(),

        supportTransition = (function(){
            var s = document.createElement('p').style,
                r = 'transition' in s ||
                    'WebkitTransition' in s ||
                    'MozTransition' in s ||
                    'msTransition' in s ||
                    'OTransition' in s;
            s = null;
            return r;
        })(),

    // WebUploader实例
        uploader;

    if ( !WebUploader.Uploader.support('flash') && WebUploader.browser.ie ) {

        // flash 安装了但是版本过低。
        if (flashVersion) {
            (function(container) {
                window['expressinstallcallback'] = function( state ) {
                    switch(state) {
                        case 'Download.Cancelled':
                            alert('您取消了更新！')
                            break;

                        case 'Download.Failed':
                            alert('安装失败')
                            break;

                        default:
                            alert('安装已成功，请刷新！');
                            break;
                    }
                    delete window['expressinstallcallback'];
                };

                var swf = 'expressInstall.swf';
                // insert flash object
                var html = '<object type="application/' +
                    'x-shockwave-flash" data="' +  swf + '" ';

                if (WebUploader.browser.ie) {
                    html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
                }

                html += 'width="100%" height="100%" style="outline:0">'  +
                '<param name="movie" value="' + swf + '" />' +
                '<param name="wmode" value="transparent" />' +
                '<param name="allowscriptaccess" value="always" />' +
                '</object>';

                container.html(html);

            })($wrap);

            // 压根就没有安转。
        } else {
            $wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');
        }

        return;
    } else if (!WebUploader.Uploader.support()) {
        alert( 'Web Uploader 不支持您的浏览器！');
        return;
    }

    // 实例化
    uploader = WebUploader.create({
        pick: {
            id: '#filePicker-2',
            label: buttontext
        },
        formData: {
            conName : 'file'
        },
        dnd: '#dndArea',
        paste: '#uploader',
        swf: '<{$domain}>lib/webuploader/0.1.5/Uploader.swf',
        chunked: false,
        chunkSize: 512 * 1024,
        server: '/member/fujian/save',
        // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
        disableGlobalDnd: true,
        fileNumLimit: 300,
        fileSizeLimit: 200 * 1024 * 1024,    // 200 M
        fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
    });

    // 拖拽时不接受 js, txt 文件。
    uploader.on( 'dndAccept', function( items ) {
        var denied = false,
            len = items.length,
            i = 0,
        // 修改js类型
            unAllowed = 'text/plain;application/javascript ';

        for ( ; i < len; i++ ) {
            // 如果在列表里面
            if ( ~unAllowed.indexOf( items[ i ].type ) ) {
                denied = true;
                break;
            }
        }

        return !denied;
    });

    uploader.on('dialogOpen', function() {
        console.log('here');
    });

    // uploader.on('filesQueued', function() {
    //     uploader.sort(function( a, b ) {
    //         if ( a.name < b.name )
    //           return -1;
    //         if ( a.name > b.name )
    //           return 1;
    //         return 0;
    //     });
    // });

    // 添加“添加文件”的按钮，
    uploader.addButton({
        id: '#filePicker2',
        label: '继续添加'
    });

    uploader.on('ready', function() {
        window.uploader = uploader;
        if(editid)
        {
            for(var i=0; i < editdata.length; i++)
            {
                var $li = $( '<li id="' + editdata[i].id + '">' +
                '<p class="title">' + editdata[i].name + '</p>' +
                '<p class="imgWrap"></p>'+
                '<p class="progress"><span></span></p>' +
                '</li>' );
                $btns = $('<div class="file-panel">' +
                '<span class="cancel">删除</span>' +
                '<span class="rotateRight">向右旋转</span>' +
                '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li );
                $prgress = $li.find('p.progress span'),
                    $wrap = $li.find( 'p.imgWrap' ),
                    img = $('<img width="110" height="110" src="'+editdata[i].name+'">');
                $wrap.empty().append( img );
                $li.appendTo( $queue );
            }
            $placeHolder.addClass( 'element-invisible' );
            $statusBar.show();
            uploader.refresh();
        }
    });
    // 当有文件添加进来时执行，负责view的创建
    function addFile( file ) {
        var notallow=['exe','iso','apk','aiv','mp4','mp3','wmv','mov','rmvb','msi'];
        for(var i=0;i<notallow.length;i++){
            if(file.ext==notallow[i]){
                layer.msg('格式不正确！请重新上传！',{icon:2,time:1000});
                return false;
            }
        }
        var $li = $( '<li id="' + file.id + '">' +
            '<p class="title">' + file.name + '</p>' +
            '<p class="imgWrap"></p>'+
            '<p class="progress"><span></span></p>' +
            '</li>' ),

            $btns = $('<div class="file-panel">' +
            '<span class="cancel">删除</span>' +
            '<span class="rotateRight">向右旋转</span>' +
            '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
            $prgress = $li.find('p.progress span'),
            $wrap = $li.find( 'p.imgWrap' ),
            $info = $('<p class="error"></p>'),

            showError = function( code ) {
                switch( code ) {
                    case 'exceed_size':
                        text = '文件大小超出';
                        break;

                    case 'interrupt':
                        text = '上传暂停';
                        break;

                    default:
                        text = '上传失败，请重试';
                        break;
                }

                $info.text( text ).appendTo( $li );
            };

        if ( file.getStatus() === 'invalid' ) {
            showError( file.statusText );
        } else {
            // @todo lazyload
            $wrap.text( '预览中' );
            uploader.makeThumb( file, function( error, src ) {
                var img;

                if ( error ) {
                    $wrap.text( '不能预览' );
                    return;
                }

                if( isSupportBase64 ) {
                    img = $('<img src="'+src+'">');
                    $wrap.empty().append( img );
                } else {
                    $.ajax('<{$domain}>lib/webuploader/0.1.5/server/preview.php', {
                        method: 'POST',
                        data: src,
                        dataType:'json'
                    }).done(function( response ) {
                        if (response.result) {
                            img = $('<img src="'+response.result+'">');
                            $wrap.empty().append( img );
                        } else {
                            $wrap.text("预览出错");
                        }
                    });
                }
            }, thumbnailWidth, thumbnailHeight );

            percentages[ file.id ] = [ file.size, 0 ];
            file.rotation = 0;
        }

        file.on('statuschange', function( cur, prev ) {
            if ( prev === 'progress' ) {
                $prgress.hide().width(0);
            } else if ( prev === 'queued' ) {
                $li.off( 'mouseenter mouseleave' );
                $btns.remove();
            }

            // 成功
            if ( cur === 'error' || cur === 'invalid' ) {
                console.log( file.statusText );
                showError( file.statusText );
                percentages[ file.id ][ 1 ] = 1;
            } else if ( cur === 'interrupt' ) {
                showError( 'interrupt' );
            } else if ( cur === 'queued' ) {
                percentages[ file.id ][ 1 ] = 0;
            } else if ( cur === 'progress' ) {
                $info.remove();
                $prgress.css('display', 'block');
            } else if ( cur === 'complete' ) {
                $li.append( '<span class="success"></span>' );
            }

            $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
        });

        $li.on( 'mouseenter', function() {
            $btns.stop().animate({height: 30});
        });

        $li.on( 'mouseleave', function() {
            $btns.stop().animate({height: 0});
        });

        $btns.on( 'click', 'span', function() {
            var index = $(this).index(),
                deg;

            switch ( index ) {
                case 0:
                    uploader.removeFile( file );
                    return;

                case 1:
                    file.rotation += 90;
                    break;

                case 2:
                    file.rotation -= 90;
                    break;
            }

            if ( supportTransition ) {
                deg = 'rotate(' + file.rotation + 'deg)';
                $wrap.css({
                    '-webkit-transform': deg,
                    '-mos-transform': deg,
                    '-o-transform': deg,
                    'transform': deg
                });
            } else {
                $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                // use jquery animate to rotation
                // $({
                //     rotation: rotation
                // }).animate({
                //     rotation: file.rotation
                // }, {
                //     easing: 'linear',
                //     step: function( now ) {
                //         now = now * Math.PI / 180;

                //         var cos = Math.cos( now ),
                //             sin = Math.sin( now );

                //         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                //     }
                // });
            }


        });

        $li.appendTo( $queue );
    }

    // 负责view的销毁
    function removeFile( file ) {
        var $li = $('#'+file.id);

        delete percentages[ file.id ];
        updateTotalProgress();
        $li.off().find('.file-panel').off().end().remove();
    }

    function updateTotalProgress() {
        var loaded = 0,
            total = 0,
            spans = $progress.children(),
            percent;

        $.each( percentages, function( k, v ) {
            total += v[ 0 ];
            loaded += v[ 0 ] * v[ 1 ];
        } );

        percent = total ? loaded / total : 0;


        spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
        spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
        updateStatus();
    }

    function updateStatus() {
        var text = '', stats;
        if ( state === 'ready' ) {
            text = '选中' + fileCount + '张图片，共' +
            WebUploader.formatSize( fileSize ) + '。';
        } else if ( state === 'confirm' ) {
            stats = uploader.getStats();
            if ( stats.uploadFailNum ) {
                text = '已成功上传' + stats.successNum+ '张照片至XX相册，'+
                stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
            }

        } else {
            stats = uploader.getStats();
            text = '共' + fileCount + '张（' +
            WebUploader.formatSize( fileSize )  +
            '），已上传' + stats.successNum + '张';

            if ( stats.uploadFailNum ) {
                text += '，失败' + stats.uploadFailNum + '张';
            }
        }

        $info.html( text );
    }

    function setState( val ) {
        var file, stats;
        if ( val === state ) {
            return;
        }

        $upload.removeClass( 'state-' + state );
        $upload.addClass( 'state-' + val );
        state = val;

        switch ( state ) {
            case 'pedding':

                $placeHolder.removeClass( 'element-invisible' );
                $queue.hide();
                $statusBar.addClass( 'element-invisible' );
                uploader.refresh();
                break;

            case 'ready':
                $placeHolder.addClass( 'element-invisible' );
                $( '#filePicker2' ).removeClass( 'element-invisible');
                $queue.show();
                $statusBar.removeClass('element-invisible');
                uploader.refresh();
                break;

            case 'uploading':
                $( '#filePicker2' ).addClass( 'element-invisible' );
                $progress.show();
                $upload.text( '暂停上传' );
                break;

            case 'paused':
                $progress.show();
                $upload.text( '继续上传' );
                break;

            case 'confirm':

                $progress.hide();
                $( '#filePicker2' ).removeClass( 'element-invisible' );

                $upload.text( '开始上传' );

                stats = uploader.getStats();
                if ( stats.successNum && !stats.uploadFailNum ) {
                    setState( 'finish' );
                    return;
                }
                break;
            case 'finish':
                stats = uploader.getStats();
                if ( stats.successNum ) {
                    layer.msg('上传成功!',{icon:1,time:1000});
                } else {
                    // 没有成功的图片，重设
                    state = 'done';
                    location.reload();
                }
                break;
        }

        updateStatus();
    }
    uploader.on( 'uploadAccept',function(obj,reJson){ //上传完成以后 处理返回的id串
        var str = $("#"+contactid).val();
        (str == "" )? str = reJson.ids : str= str+","+reJson.ids;
        $("#"+contactid).attr('value',str);
    });
    uploader.onUploadProgress = function( file, percentage ) {
        var $li = $('#'+file.id),
            $percent = $li.find('.progress span');

        $percent.css( 'width', percentage * 100 + '%' );
        percentages[ file.id ][ 1 ] = percentage;
        updateTotalProgress();
    };

    uploader.onFileQueued = function( file ) {
        fileCount++;
        fileSize += file.size;

        if ( fileCount === 1 ) {
            $placeHolder.addClass( 'element-invisible' );
            $statusBar.show();
        }
        if(fileCount>maxnum){
            layer.msg('请上传'+maxnum+'张以内照片!',{icon:2,time:1000});
            return false;
        }
        addFile( file );
        setState( 'ready' );
        updateTotalProgress();
    };

    uploader.onFileDequeued = function( file ) {
        fileCount--;
        fileSize -= file.size;

        if ( !fileCount ) {
            setState( 'pedding' );
        }

        removeFile( file );
        updateTotalProgress();

    };

    uploader.on( 'all', function( type ) {
        var stats;
        switch( type ) {
            case 'uploadFinished':
                setState( 'confirm' );
                break;

            case 'startUpload':
                setState( 'uploading' );
                break;

            case 'stopUpload':
                setState( 'paused' );
                break;
        }
    });

    uploader.onError = function( code ) {
        alert( 'Eroor: ' + code );
    };

    $upload.on('click', function() {
        if ( $(this).hasClass( 'disabled' ) ) {
            return false;
        }
        if ( state === 'ready' ) {
            uploader.upload();
        } else if ( state === 'paused' ) {
            uploader.upload();
        } else if ( state === 'uploading' ) {
            uploader.stop();
        }
    });

    $info.on( 'click', '.retry', function() {
        uploader.retry();
    } );

    $info.on( 'click', '.ignore', function() {
        alert( 'todo' );
    } );

    $upload.addClass( 'state-' + state );
    updateTotalProgress();
}