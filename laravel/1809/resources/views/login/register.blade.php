<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>注册</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link href="css/vccode.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="layui/css/layui.css">
    <script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">注册</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>
<div class="wrapper">
    <input name="hidForward" type="hidden" id="hidForward" />
    <div class="registerCon">
        <ul>
            <li class="accAndPwd">
                <dl>
                    <s class="phone"></s>
                    <input id="userMobile"  maxlength="11"  type="number" placeholder="请输入您的手机号码" value="" />
                    <span class="clear">x</span>
                </dl>
                <dl>
                    <s class="phone"></s>
                    <input id="usercode" style="width: 70%" maxlength="11"  type="number" placeholder="请输验证码" value="" />
                    <button type="button" 	class="layui-btn layui-btn-fluid" id="dateBtn1">获取验证码</button>
                    <span class="clear">x</span>
                </dl>

                <dl>
                    <s class="password"></s>
                    <input class="pwd" maxlength="11" type="text"   placeholder="6-16位数字、字母组成" value="" />
                    <input class="pwd" maxlength="11" type="password"  placeholder="6-16位数字、字母组成" value="" style="display: none" />
                    <span class="mr clear">x</span>
                    <s class="eyeclose"></s>
                </dl>
                <dl>
                    <s class="password"></s>
                    <input class="conpwd" maxlength="11" type="text"  placeholder="请确认密码" value="" />
                    <input class="conpwd" maxlength="11" type="password"  placeholder="请确认密码" value="" style="display: none" />
                    <span class="mr clear">x</span>
                    <s class="eyeclose"></s>
                </dl>
                <dl class="a-set">
                    <i class="gou"></i><p>我已阅读并同意《666潮人购购物协议》</p>
                </dl>

            </li>
            <li><a id="btnNext" href="javascript:;" class="orangeBtn loginBtn">下一步</a></li>
        </ul>
    </div>


    <div class="footer clearfix" style="display:none;">
        <ul>
            <li class="f_home"><a href="/v44/index.do" ><i></i>云购</a></li>
            <li class="f_announced"><a href="/v44/lottery/" ><i></i>最新揭晓</a></li>
            <li class="f_single"><a href="/v44/post/index.do" ><i></i>晒单</a></li>
            <li class="f_car"><a id="btnCart" href="/v44/mycart/index.do" ><i></i>购物车</a></li>
            <li class="f_personal"><a href="/v44/member/index.do" ><i></i>我的云购</a></li>
        </ul>
    </div>
    <div class="layui-layer-move"></div>

    <script src="layui/layui.js"></script>
    <script>
        $('.registerCon input').bind('keydown',function(){
            var that = $(this);
            if(that.val().trim()!=""){

                that.siblings('span.clear').show();
                that.siblings('span.clear').click(function(){
                    console.log($(this));

                    that.parents('dl').find('input:visible').val("");
                    $(this).hide();
                })

            }else{
                that.siblings('span.clear').hide();
            }

        })
        function show(){
            if($('.registerCon input').attr('type')=='password'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        function hide(){
            if($('.registerCon input').attr('type')=='text'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        $('.registerCon s').bind({click:function(){
                if($(this).hasClass('eye')){
                    $(this).removeClass('eye').addClass('eyeclose');

                    $(this).prev().prev().prev().val($(this).prev().prev().val());
                    $(this).prev().prev().prev().show();
                    $(this).prev().prev().hide();


                }else{
                    console.log($(this  ));
                    $(this).removeClass('eyeclose').addClass('eye');
                    $(this).prev().prev().val($(this).prev().prev().prev().val());
                    $(this).prev().prev().show();
                    $(this).prev().prev().prev().hide();

                }
            }
        })

        function registertel(){
            // 手机号失去焦点
            $('#userMobile').blur(function(){
                reg=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/;//验证手机正则(输入前7位至11位)
                var that = $(this);

                if( that.val()==""|| that.val()=="请输入您的手机号")
                {
                    layer.msg('请输入您的手机号！');
                }
                else if(that.val().length<11)
                {
                    layer.msg('您输入的手机号长度有误！');
                }
                else if(!reg.test($("#userMobile").val()))
                {
                    layer.msg('您输入的手机号不存在!');
                }
                else if(that.val().length == 11){
                    // ajax请求后台数据
                }
            })
            // 密码失去焦点
            $('.pwd').blur(function(){
                reg=/^[0-9a-zA-Z]{6,16}$/;
                var that = $(this);
                if( that.val()==""|| that.val()=="6-16位数字或字母组成")
                {
                    layer.msg('请设置您的密码！');
                }else if(!reg.test($(".pwd").val())){
                    layer.msg('请输入6-16位数字或字母组成的密码!');
                }
            })

            // 重复输入密码失去焦点时
            $('.conpwd').blur(function(){
                var that = $(this);
                var pwd1 = $('.pwd').val();
                var pwd2 = that.val();
                if(pwd1!=pwd2){
                    layer.msg('您俩次输入的密码不一致哦！');
                }
            })

        }
        registertel();
        // 购物协议
        $('dl.a-set i').click(function(){
            var that= $(this);
            if(that.hasClass('gou')){
                that.removeClass('gou').addClass('none');
                $('#btnNext').css('background','#ddd');

            }else{
                that.removeClass('none').addClass('gou');
                $('#btnNext').css('background','#f22f2f');
            }

        })
        // 下一步提交
        $('#btnNext').click(function() {
            if ($('#userMobile').val() == '') {
                layer.msg('请输入您的手机号！');
            }else if($('#usercode').val()=='') {
                layer.msg('请输入验证码');
            }else if ($('.pwd').val() == '') {
                layer.msg('请输入您的密码!');
            } else if ($('.conpwd').val() == '') {
                layer.msg('请您再次输入密码！');
            }else{
                var data = {};//json数据格式
                var tel = $('#userMobile').val();
                var pwd = $('.pwd').val();
                var conpwd = $('.conpwd').val();
                var code=$('#usercode').val();
                data.tel = tel;
                data.pwd = pwd;
                data.conpwd = conpwd;
                data.code=code;
                var url = "add";
                //console.log(data);exit;
                $.ajax({
                    type: "post",
                    data: data,
                    dataType: "json",
                    url: url,
                    success: function (msg) {
                        if(msg.status==0){
                            layer.msg(msg.msg);

                        }else{

                            location.href="login";
                        }


                    }
                });
            }

        })






    </script>
    <script src="js/all.js"></script>
</body>
</html>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="js/leftTime.min.js"></script>
<script type="text/javascript">
    $(function(){
        //60秒倒计时
        $("#dateBtn1").on("click",function(){
            var data = {};//json数据格式
            var tel = $('#userMobile').val();
            data.tel=tel;
            var url="code";
            $.ajax({
                type: "post",
                data: data,
                dataType: "json",
                url: url,
                success(msg){
                    if(msg.status==0){
                        layer.msg(msg.msg);

                    }else{

                       layer.msg(msg.msg);
                    }
                }
            })
            var _this=$(this);
            if(!$(this).hasClass("on")){
                $.leftTime(60,function(d){
                    if(d.status){
                        _this.addClass("on");
                        _this.html((d.s=="00"?"60":d.s)+"秒后重新获取");
                    }else{
                        _this.removeClass("on");
                        _this.html("获取验证码");
                    }
                });
            }
        });
    });
</script>
