
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>666潮人购</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="layui/css/layui.css">
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/index.css" rel="stylesheet" type="text/css" />

</head>
<body fnav="1" class="g-acc-bg">
<div class="marginB" id="loadingPicBlock">
    <!--首页头部-->
    <div class="m-block-header" style="display: none">
        <div class="search"></div>
        <a href="/" class="m-public-icon m-1yyg-icon"></a>
    </div>
    <!--首页头部 end-->

    <!-- 关注微信 -->
    <div id="div_subscribe" class="app-icon-wrapper" style="display: none;">
        <div class="app-icon">
            <a href="javascript:;" class="close-icon"><i class="set-icon"></i></a>
            <a href="javascript:;" class="info-icon">
                <i class="set-icon"></i>
                <div class="info">
                    <p>点击关注666潮人购官方微信^_^</p>
                </div>
            </a>
        </div>
    </div>

    <!-- 焦点图 -->
    <div class="hotimg-wrapper">
        <div class="hotimg-top"></div>
        <section id="sliderBox" class="hotimg">
            <ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
                <li style="width: 414px; float: left; display: block;" class="clone">
                    <a href="">
                        <img  width="30%" src="{{URL::asset('uploads\brandlogo\20181129/a1.jpg')}}" alt="">
                    </a>
                </li>
                <li class="" style="width: 414px; float: left; display: block;">
                    <a href="">
                        <img width="30%" height="50%" src="{{URL::asset('uploads\brandlogo\20181129/a2.jpg')}}" alt="">
                    </a>
                </li>
                <li style="width: 414px; float: left; display: block;" class="flex-active-slide">
                    <a href=""><img   src="{{URL::asset('uploads\brandlogo\20181129/a10.jpg')}}" alt="">
                    </a>
                </li>
                <li style="width: 414px; float: left; display: block;" class="">
                    <a href=""><img width="50px" src="{{URL::asset('uploads\brandlogo\20181129/a8.jpg')}}" alt=""></a>
                </li>
                <li style="width: 414px; float: left; display: block;" class="">
                    <a href="">
                        <img width="30%" height="50%" src="{{URL::asset('uploads\brandlogo\20181129/a6.jpg')}}" alt="">
                    </a>
                </li>
                <li class="clone" style="width: 414px; float: left; display: block;">
                    <a href="">
                        <img width="30%" height="50%" src="{{URL::asset('uploads\brandlogo\20181129/a3.jpg')}}" alt="">
                    </a>
                </li>
            </ul>
        </section>
    </div>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> <script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script>
    <script>
      //  $(function () {
        //   $('.hotimg').flexslider({
        ///       directionNav: false,   //是否显示左右控制按钮
         //       controlNav: true,   //是否显示底部切换按钮
         //       pauseOnAction: false,  //手动切换后是否继续自动轮播,继续(false),停止(true),默认true
          //      animation: 'slide',   //淡入淡出(fade)或滑动(slide),默认fade
          //      slideshowSpeed: 3000,  //自动轮播间隔时间(毫秒),默认5000ms
           //     animationSpeed: 150,   //轮播效果切换时间,默认600ms
           //     direction: 'horizontal',  //设置滑动方向:左右horizontal或者上下vertical,需设置animation: "slide",默认horizontal
           //    randomize: false,   //是否随机幻切换
            //    animationLoop: true   //是否循环滚动
         //   });
          //  setTimeout($('.flexslider img').fadeIn());
       // });
   </script>
    <!--分类-->
    <div class="index-menu thin-bor-top thin-bor-bottom">
        <ul class="menu-list">
            <li>
                <a href="javascript:;" id="btnNew">
                    <i class="xinpin"></i>
                    <span class="title">新品</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" id="btnRecharge">
                    <i class="chongzhi"></i>
                    <span class="title">充值</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" id="btnLimitbuy">
                    <i class="contact"></i>
                    <span class="title">联系我们</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" id="btnDownApp">
                    <i class="xiazai"></i>
                    <span class="title">下载APP</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" id="btnAllGoods">
                    <i class="fenlei"></i>
                    <span class="title">晒单</span>
                </a>
            </li>
        </ul>
    </div>
    <!--导航-->
    <div class="success-tip">
        <div class="left-icon"></div>
        <ul class="right-con">
            <li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
            </li>
            <li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
            </li>
            <li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
            </li>
        </ul>
    </div>
    <!-- 倒計時 -->
    <div class="endtime">
        <ul class="endtime-list clearfix">
            <li>
                <a href="" class="endtime-img"><img src="images/goods1.jpg" alt=""></a>
                <p>倒计时</p>
                <div class="pro-state">
                    <div class="time-wrapper time" value="1500560400">
                        <em>02</em>
                        <span>:</span>
                        <em>24</em>
                        <span>:</span>
                        <em><i>8</i><i>4</i></em>
                    </div>
                </div>
            </li>
            <li>
                <a href="" class="endtime-img"><img src="images/goods1.jpg" alt=""></a>
                <p>倒计时</p>
                <div class="pro-state">
                    <div class="time-wrapper time" value="1500560400">
                        <em>02</em>
                        <span>:</span>
                        <em>24</em>
                        <span>:</span>
                        <em><i>8</i><i>4</i></em>
                    </div>
                </div>
            </li>
            <li>
                <a href="" class="endtime-img"><img src="images/goods1.jpg" alt=""></a>
                <p>倒计时</p>
                <div class="pro-state">
                    <div class="time-wrapper time" value="1500560400">
                        <em>02</em>
                        <span>:</span>
                        <em>24</em>
                        <span>:</span>
                        <em><i>8</i><i>4</i></em>
                    </div>
                </div>
            </li>
            <li>
                <a href="" class="endtime-img"><img src="images/goods1.jpg" alt=""></a>
                <p>倒计时</p>
                <div class="pro-state">
                    <div class="time-wrapper time"  value="1500560400">
                        <em>02</em>
                        <span>:</span>
                        <em>24</em>
                        <span>:</span>
                        <em><i>8</i><i>4</i></em>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- 热门推荐 -->
    <div class="line hot">
        <div class="hot-content">
            <i></i>
            <span>潮人推荐</span>
            <div class="l-left"></div>
            <div class="l-right"></div>
        </div>
    </div>
    <div class="hot-wrapper">
        <ul class="clearfix">
            @foreach($sql as $v)
            <li style="border-right:1px solid #e4e4e4; ">
                <a href="">
                    <p class="title">{{$v->goods_name}}</p>
                    <p class="subtitle"></p>
                    <img src="{{URL::asset('uploads/goodsimg/'.$v->goods_img)}}" alt="">
                </a>
            </li>
          @endforeach
        </ul>
    </div>
    <!-- 猜你喜欢 -->
    <div class="line guess">
        <div class="hot-content">
            <i></i>
            <span>猜你喜欢</span>
            <div class="l-left"></div>
            <div class="l-right"></div>
        </div>
    </div>
    <!--商品列表-->
    <div class="goods-wrap marginB">
        <ul id="ulGoodsList" class="goods-list clearfix"  class="flow-default"></ul>
    </div>
    <div class="goods-wrap marginB">
        <ul id="demo" class="goods-list clearfix"  class="flow-default"></ul>
    </div>

    <!--底部-->
    <div class="footer clearfix">
        <ul>
            <li class="f_home"><a href="/v41/index.do" class="hover"><i></i>潮购</a></li>
            <li class="f_announced"><a href="cate" ><i></i>所有商品</a></li>
            <li class="f_single"><a href="/v41/post/index.do" ><i></i>最新揭晓</a></li>
            <li class="f_car"><a id="btnCart" href="/v41/mycart/index.do" ><i></i>购物车</a></li>
            <li class="f_personal"><a href="/v41/member/index.do" ><i></i>我的潮购</a></li>
        </ul>
    </div>
    <div id="div_fastnav" class="fast-nav-wrapper">
        <ul class="fast-nav">
            <li id="li_menu" isshow="0">
                <a href="javascript:;"><i class="nav-menu"></i></a>
            </li>
            <li id="li_top" style="display: none;">
                <a href="javascript:;"><i class="nav-top"></i></a>
            </li>
        </ul>
        <div class="sub-nav four" style="display: none;">
            <a href="#"><i class="announced"></i>最新揭晓</a>
            <a href="#"><i class="single"></i>晒单</a>
            <a href="#"><i class="personal"></i>我的潮购</a>
            <a href="#"><i class="shopcar"></i>购物车</a>
        </div>
    </div>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="layui/layui.js"></script>
    <script src="js/all.js"></script>
    <script src="js/index.js"></script>
    <script src="js/lazyload.min.js"></script>
    <script>

        jQuery(document).ready(function() {
            $("img.lazy").lazyload({
                placeholder : "images/loading2.gif",
                effect: "fadeIn",
            });

            // 返回顶部点击事件
            $('#div_fastnav #li_menu').click(
                function(){
                    if($('.sub-nav').css('display')=='none'){
                        $('.sub-nav').css('display','block');
                    }else{
                        $('.sub-nav').css('display','none');
                    }

                }
            )
            $("#li_top").click(function(){
                $('html,body').animate({scrollTop:0},300);
                return false;
            });

            $(window).scroll(function(){
                if($(window).scrollTop()>200){
                    $('#li_top').css('display','block');
                }else{
                    $('#li_top').css('display','none');
                }

            })


        });

        layui.use('flow', function(){
            var $ = layui.jquery; //不用额外加载jQuery，flow模块本身是有依赖jQuery的，直接用即可。
            var flow = layui.flow;

            flow.load({
                elem: '#demo' //指定列表容器
                ,done: function(page, next){ //到达临界点（默认滚动触发），触发下一页
                    data={};
                    data.page=page;
                    var url="loading";
                    $.ajax({
                        type:'post',
                        data:data,
                        url:url,
                        success:function (msg) {
                            var info=msg.info;
                            var pageTotal=msg.page;
                            $("#ulGoodsList").append(info);
                            next('',page<pageTotal);
                        }
                    });
                }
            });
        });


    </script>
</body>
</html>