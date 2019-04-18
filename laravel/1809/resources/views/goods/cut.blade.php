<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购物车</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/cartlist.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="layui/css/layui.css">
</head>
<body id="loadingPicBlock" class="g-acc-bg">
<input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
<div>
    <!--首页头部-->
    <div class="m-block-header">
        <a href="/" class="m-public-icon m-1yyg-icon"></a>
        <a href="/" class="m-index-icon">编辑</a>
    </div>
    <!--首页头部 end-->
    @foreach($data as $v)
    <div class="g-Cart-list">

        <ul id="cartBody">

            <li id="{{$v->goods_selfprice}}}">
                <s class="xuan current" gid="{{$v->goods_id}}"></s>
                <a class="fl u-Cart-img" href="/v44/product/12501977.do">
                    <img src="{{URL::asset('uploads/goodsimg/'.$v->goods_img)}}" border="0" alt="">
                </a>
                <div class="u-Cart-r">
                    <a href="/v44/product/12501977.do" class="gray6">(已更新至第{{$v->goods_id}}潮){{$v->goods_name}}</a>
                    <span class="gray9">
                            <em>￥{{$v->goods_selfprice}}</em>
                        </span>
                    <div class="num-opt">
                        <em class="num-mius dis min" gid="{{$v->goods_id}}"><i></i></em>
                        <input class="text_box" id="text" gid="{{$v->goods_id}}" name="num" maxlength="6" type="number" value="{{$v->buy_number}}" codeid="12501977" onkeyup="value=(parseInt((value=value.replace(/\D/g,''))==''||parseInt((value=value.replace(/\D/g,''))==0)?'1':value,10))" onafterpaste="value=(parseInt((value=value.replace(/\D/g,''))==''||parseInt((value=value.replace(/\D/g,''))==0)?'1':value,10))">
                        <em class="num-add add" gid="{{$v->goods_id}}"><i></i></em>
                    </div>
                    <a href="javascript:;" name="delLink" gid="{{$v->goods_id}}" cid="12501977" isover="0" class="z-del"><s></s></a>
                </div>
            </li>
        </ul>
        <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>

    </div>
    @endforeach
    <div id="mycartpay" class="g-Total-bt g-car-new" style="">
        <dl>
            <dt class="gray6">
                <s class="quanxuan current"></s>全选
                <p class="money-total">合计<em class="orange total"><span>￥</span></em></p>

            </dt>
            <dd>
                <a href="javascript:;" id="a_payment" class="orangeBtn w_account remove" id="demo">删除</a>
                <a href="det" id="a_payment" class="orangeBtn w_account pay">去结算</a>
            </dd>
        </dl>
    </div>
    <div class="hot-recom">
        <div class="title thin-bor-top gray6">
            <span><b class="z-set"></b>人气推荐</span>
            <em></em>
        </div>
        <div class="goods-wrap thin-bor-top">
            <ul class="goods-list clearfix">
                @foreach($res as $v)
                <li>
                    <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                        <img src="{{URL::asset('uploads/goodsimg/'.$v->goods_img)}}" width="136" height="136">
                    </a>
                    <p class="g-name">
                        <a href="https://m.1yyg.com/v44/products/23458.do">(第<i>{{$v->goods_id}}</i>潮){{$v->goods_name}}</a>
                    </p>
                    <ins class="gray9">价值:￥{{$v->goods_selfprice}}</ins>
                    <div class="btn-wrap">
                        <div class="Progress-bar">
                            <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                            </p>
                        </div>
                        <div class="gRate" data-productid="23458">
                            <a href="javascript:;"><s id="del"></s></a>
                        </div>
                    </div>
                </li>
             @endforeach
            </ul>
        </div>
    </div>




    <div class="footer clearfix">
        <ul>
            <li class="f_home"><a href="/v41/index.do" ><i></i>潮购</a></li>
            <li class="f_announced"><a href="/v41/lottery/" ><i></i>最新揭晓</a></li>
            <li class="f_single"><a href="/v41/post/index.do" ><i></i>晒单</a></li>
            <li class="f_car"><a id="btnCart" href="/v41/mycart/index.do" class="hover"><i></i>购物车</a></li>
            <li class="f_personal"><a href="/v41/member/index.do" ><i></i>我的潮购</a></li>
        </ul>
    </div>
    <script src="layui/layui.js"></script>
    <script src="js/jquery-1.11.2.min.js"></script>
    <!---商品加减算总数---->
    <script type="text/javascript">
        $(function () {
            $(".add").click(function () {
                var _this = $(this);
                var goods_id = _this.attr('gid');
                //console.log(goods_id);
                var t = $(this).prev();
                t.val(parseInt(t.val()) + 1);
                GetCount();
                var url = "crt";
                var data = {};
                data.goods_id =goods_id;
                $.ajax({
                    type: "post",
                    data: data,
                    dataType: "json",
                    url: url,
                    success: function (msg) {
                        if(msg.status==0){
                            layer.msg(msg.msg);
                        }else{
                            layer.msg(msg.msg);
                        }

                    }
                });
            })
            $(".min").click(function () {
                var _this = $(this);
                var goods_id = _this.attr('gid');
                //console.log(goods_id);
                var t = $(this).next();
                if(t.val()>1){
                    t.val(parseInt(t.val()) - 1);
                    GetCount();
                    var url = "dis";
                    var data = {};
                    data.goods_id =goods_id;
                    $.ajax({
                        type: "post",
                        data: data,
                        dataType: "json",
                        url: url,
                        success: function (msg) {
                            if(msg.status==0){
                                layer.msg(msg.msg);
                            }else{
                                layer.msg(msg.msg);
                            }

                        }
                    });
                }
            })

        })
        layui.use("layer",function() {
            var layer = layui.layer;
            $(".text_box").blur(function () {
                var _this = $(this);
                var goods_id = _this.attr('gid');
                // console.log(goods_id);
                var text = $("#text").val();
                //  console.log(text);
                var url = "data";
                var data = {};
                data.goods_id = goods_id;
                data.text = text;
                $.ajax({
                    type: "post",
                    data: data,
                    dataType: "json",
                    url: url,
                    success: function (msg) {
                        if(msg.status==0){
                            layer.msg(msg.msg);
                        }else{
                            layer.msg(msg.msg);
                        }



                    }
                });
            });

        });
        $('.z-del').click(function (){
            var _this = $(this);
            var goods_id = _this.attr('gid');
           // console.log(goods_id);
            var url = "delect";
            var data = {};
            data.goods_id = goods_id;

            $.ajax({
                type: "post",
                data: data,
                dataType: "json",
                url: url,
                success: function (msg) {
                    //console.log(msg);
                    // if(msg.status==0){
                    //     layer.msg(msg.msg);
                    // }else{
                    //     layer.msg(msg.msg);
                    // }
                        alert('删除成功');
                    location.href='';

                }
            });
        })
    </script>



    <script>

        // 全选
        $(".quanxuan").click(function () {
            if($(this).hasClass('current')){
                $(this).removeClass('current');

                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        $(this).removeClass("current");
                    } else {
                        $(this).addClass("current");
                    }
                });
                GetCount();

            }else{
                $(this).addClass('current');

                $(".g-Cart-list .xuan").each(function () {
                    $(this).addClass("current");
                    // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
                });
                GetCount();

            }


        });
        // 单选
        $(".g-Cart-list .xuan").click(function () {
            if($(this).hasClass('current')){


                $(this).removeClass('current');

            }else{
                $(this).addClass('current');
            }
            if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                $('.quanxuan').addClass('current');
            }else{
                $('.quanxuan').removeClass('current');
            }
            // $("#total2").html() = GetCount($(this));
            GetCount();



            //alert(conts);
        });
        // 已选中的总额
        function GetCount() {
            var conts = 0;
            var aa = 0;
            $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    for (var i = 0; i < $(this).length; i++) {
                        conts += parseInt($(this).parents('li').find('input.text_box').val())*parseInt($(this).parents('li').attr('id'));
                        // aa += 1;
                    }
                }
            });

            $(".total").html('<span>￥</span>'+(conts).toFixed(2));
        }
        GetCount();
            $(document).on('click','.remove',function(){
                var id=[];
                $(".g-Cart-list .xuan").each(function () {

                    if ($(this).hasClass("current")) {
                        var _this = $(this);
                        id.push(_this.attr('gid'));
                    }
                })
               // console.log(id);
                var url = "set";
                var data = {};
                data.id = id;

                $.ajax({
                    type: "post",
                    data: data,
                    dataType: "json",
                    url: url,
                    success: function (msg) {

                         if(msg.status==0){
                             layer.msg(msg.msg);
                         }else{
                             layer.msg(msg.msg);
                             location.href='';
                         }


                    }
                });
            })
        $(document).on('click','.pay',function(){
            var id=[];
            $(".g-Cart-list .xuan").each(function () {

                if ($(this).hasClass("current")) {
                    var _this = $(this);
                    id.push(_this.attr('gid'));
                }
            })
             //console.log(id);
            var url = "detil";
            var data = {};
            data.id = id;

            $.ajax({
                type: "post",
                data: data,
                dataType: "json",
                url: url,
                success: function (msg) {
                    if(msg.status==0){
                        layer.msg(msg.msg);
                        location.href="login";
                    }else{
                        layer.msg(msg.msg);

                    }



                }
            });
        })


    </script>
</body>
</html>