<!DOCTYPE html>
<html lang="en">
<head>
    <title>商品列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link rel="stylesheet" href="css/mui.min_1.css">
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/goods.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="layui/css/layui.css">
</head>

<body class="g-acc-bg" fnav="0" style="position: static">
<div class="page-group">
    <div id="page-infinite-scroll-bottom" class="page">

        <!--触屏版内页头部-->
        <div class="m-block-header" id="div-header" style="display: none">
            <strong id="m-title"></strong>
            <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
            <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
        </div>

        <div class="pro-s-box thin-bor-bottom" id="divSearch">
            <div class="box">
                <div class="border">
                    <div class="border-inner"></div>
                </div>
                <div class="input-box">
                    <i class="s-icon"></i>
                    <input type="text" placeholder="输入“汽车”试试" id="txtSearch" />
                    <i class="c-icon" id="btnClearInput" style="display: none"></i>
                </div>
            </div>
            <a href="javascript:;" class="s-btn" id="btnSearch">搜索</a>
        </div>

        <!--搜索时显示的模块-->
        <div class="search-info" style="display: none;">
            <div class="hot">
                <p class="title">热门搜索</p>
                <ul id="ulSearchHot" class="hot-list clearfix"><li wd='iPhone'><a class="items">iPhone</a></li><li wd='三星'><a class="items">三星</a></li><li wd='小米'><a class="items">小米</a></li><li wd='黄金'><a class="items">黄金</a></li><li wd='汽车'><a class="items">汽车</a></li><li wd='电脑'><a class="items">电脑</a></li></ul>
            </div>
            <div class="history" style="display: none">
                <p class="title">历史记录</p>
                <div class="his-inner" id="divSearchHotHistory">
                    <ul class="his-list thin-bor-top">
                        <li wd="小米移动电源" class="thin-bor-bottom"><a class="items">小米移动电源</a></li>
                        <li wd="苹果6" class="thin-bor-bottom"><a class="items">苹果6</a></li>
                        <li wd="苹果电脑" class="thin-bor-bottom"><a class="items">苹果电脑</a></li>
                    </ul>
                    <div class="cle-cord thin-bor-bottom" id="btnClear">清空历史记录</div>
                </div>
            </div>
        </div>

        <div class="all-list-wrapper">

            <div class="menu-list-wrapper" id="divSortList">
                <ul id="sortListUl" class="list">
                    <li sortid='0' class='current' id="all">
                        <span class='items'>全部商品</span>
                    </li>
                    @foreach($cate as $k=>$v)
                    <li sortid='100' reletype='1' linkaddr='' id="{{$v->cate_id}}">
                        <span class='items' >{{$v->cate_name}}</span>
                    </li>
                    @endforeach
                    <li sortid='130' reletype='1' linkaddr=''id="els">
                        <span class='items'>其他商品</span>
                    </li>
                </ul>
            </div>

            <div class="good-list-wrapper">
                <div class="good-menu thin-bor-bottom">
                    <ul class="good-menu-list" id="ulOrderBy">
                        <li orderflag="10" class="current"><a href="javascript:;">即将揭晓</a></li>
                        <li orderflag="20"><a href="javascript:;">人气</a></li>
                        <li orderflag="50"><a href="javascript:;">最新</a></li>
                        <li orderflag="30"><a href="javascript:;">价值</a><span class="i-wrap"><i class="up"></i>
                                <i class="down"></i></span></li>
                        <!--价值(由高到低30,由低到高31)-->
                    </ul>
                </div>

                <div class="good-list-inner">

                    <div id="pullrefresh" class="good-list-box  mui-content mui-scroll-wrapper">
                        <div class="goodList mui-scroll">
                        <ul id="ulGoodsList" class="mui-table-view mui-table-view-chevron"></ul>
                        <div >
                            <ul id="demo"></ul>
                        </div>
                    </div>

                </div>

            </div>


        </div>

        <div class="footer clearfix">
            <ul>
                <li class="f_home"><a href="/v41/index.do" ><i></i>潮购</a></li>
                <li class="f_announced"><a href="goods" class="hover"><i></i>全部商品</a></li>
                <li class="f_single"><a href="/v41/post/index.do" ><i></i>最新揭晓</a></li>
                <li class="f_car"><a id="btnCart" href="/v41/mycart/index.do" ><i></i>购物车</a></li>
                <li class="f_personal"><a href="user" ><i></i>我的潮购</a></li>
            </ul>
        </div>
    </div>
</div>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/lazyload.min.js"></script>
<script src="js/mui.min.js"></script>
<script src="layui/layui.js"></script>
<script>

    jQuery(document).ready(function() {
        $("img.lazy").lazyload({
            placeholder : "images/loading2.gif",
            effect: "fadeIn",
        });


    });

</script>
<script>
    // 点击切换类别
    $('#sortListUl li').click(function(){
        $(this).addClass('current').siblings('li').removeClass('current');

        var data = {};//json数据格式
        var cate_id = $("#sortListUl .current").attr('id');
       // console.log(cate_id);
        data.cate_id=cate_id;


       // data.nav=nav;
        var url = "loadend";
        //console.log(data);exit;
        $.ajax({
            type: "post",
            data: data,
            dataType: "json",
            url: url,
            success: function (msg) {
                $("#ulGoodsList").empty()
                $("#ulGoodsList").append(msg.info)


            }
        });

    })
</script>
<script>
    mui.init({
        pullRefresh: {
            container: '#pullrefresh',
            down: {
                contentdown : "下拉可以刷新",//可选，在下拉可刷新状态时，下拉刷新控件上显示的标题内容
                contentover : "释放立即刷新",//可选，在释放可刷新状态时，下拉刷新控件上显示的标题内容
                contentrefresh : "正在刷新...",
                callback: pulldownRefresh
            },
            up: {
                contentrefresh: '正在加载...',
                callback: pullupRefresh
            }
        }
    });
    /**
     * 下拉刷新具体业务实现
     */
    function pulldownRefresh() {
        setTimeout(function() {
            var table = document.body.querySelector('.mui-table-view');
            var cells = document.body.querySelectorAll('.mui-table-view-cell');
            for (var i = cells.length, len = i + 3; i < len; i++) {
                var li = document.createElement('li');
                var str='';
                // li.className = 'mui-table-view-cell';
                str += '<span class="gList_l fl">';
                str += '<img class="lazy" data-original="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" src="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" style="display: block;"/>';
                str += '</span>';
                str += '<div class="gList_r">';
                str += '<h3 class="gray6">(第'+i+'云)苹果（Apple）iPhone 7 Plus 256G版 4G手机</h3>';
                str += '<em class="gray9">价值：￥7988.00</em>';
                str += '<div class="gRate">';
                str += '<div class="Progress-bar">'
                str += '<p class="u-progress">';
                str += '<span style="width: 91.91286930395593%;" class="pgbar">';
                str += '<span class="pging"></span>';
                str += '</span>';
                str += '</p>';
                str += '<ul class="Pro-bar-li">';
                str += '<li class="P-bar01"><em>7342</em>已参与</li>';
                str += '<li class="P-bar02"><em>7988</em>总需人次</li>';
                str += '<li class="P-bar03"><em>646</em>剩余</li>';
                str += '</ul>';
                str += '</div>';
                str += '<a codeid="12785750" class="" canbuy="646"><s></s></a>';
                str += '</div>';
                str += '</div>';
                //下拉刷新，新纪录插到最前面；
                li.innerHTML = str;
                table.insertBefore(li, table.firstChild);
            }
            mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
        }, 1500);
    }
    var count = 0;
    /**
     * 上拉加载具体业务实现
     */
    function pullupRefresh() {
        setTimeout(function() {
            mui('#pullrefresh').pullRefresh().endPullupToRefresh((++count > 2)); //参数为true代表没有更多数据了。
            var table = document.body.querySelector('.mui-table-view');
            var cells = document.body.querySelectorAll('.mui-table-view-cell');
            for (var i = cells.length, len = i + 20; i < len; i++) {
                var li = document.createElement('li');
                // li.className = 'mui-table-view-cell';
                var str='';
                str += '<span class="gList_l fl">';
                str += '<img class="lazy" data-original="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" src="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" style="display: block;"/>';
                str += '</span>';
                str += '<div class="gList_r">';
                str += '<h3 class="gray6">(第'+i+'云)苹果（Apple）iPhone 7 Plus 256G版 4G手机</h3>';
                str += '<em class="gray9">价值：￥7988.00</em>';
                str += '<div class="gRate">';
                str += '<div class="Progress-bar">'
                str += '<p class="u-progress">';
                str += '<span style="width: 91.91286930395593%;" class="pgbar">';
                str += '<span class="pging"></span>';
                str += '</span>';
                str += '</p>';
                str += '<ul class="Pro-bar-li">';
                str += '<li class="P-bar01"><em>7342</em>已参与</li>';
                str += '<li class="P-bar02"><em>7988</em>总需人次</li>';
                str += '<li class="P-bar03"><em>646</em>剩余</li>';
                str += '</ul>';
                str += '</div>';
                str += '<a codeid="12785750" class="" canbuy="646"><s></s></a>';
                str += '</div>';
                str += '</div>';
                li.innerHTML = str;
                table.appendChild(li);
            }
        }, 1500);
    }


        layui.use('flow', function(){
        var $ = layui.jquery; //不用额外加载jQuery，flow模块本身是有依赖jQuery的，直接用即可。
        var flow = layui.flow;

        flow.load({
            elem: '#demo' //指定列表容器
            ,done: function(page, next){ //到达临界点（默认滚动触发），触发下一页
                var data={};
                data.page=page;
               // console.log(data)
                var url="loadend";
                $.ajax({
                    type:'post',
                    data:data,
                    url:url,
                    success:function (msg) {
                        var info=msg.info;
                        var pageTotal=msg.page;
                        $("#ulGoodsList").append(info);
                        next("",page<pageTotal);
                    }
                });
            }
        });
    });

    // if (mui.os.plus) {
    //     mui.plusReady(function() {
    //         setTimeout(function() {
    //             mui('#pullrefresh').pullRefresh().pullupLoading();
    //         }, 1000);

    //     });
    // }
    // else {
    //     mui.ready(function() {
    //         mui('#pullrefresh').pullRefresh().pullupLoading();
    //     });
    // }
</script>

</body>
</html>