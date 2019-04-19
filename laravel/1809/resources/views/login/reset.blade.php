<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>重置密码</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link href="css/findpwd.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">重置密码</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>


<div class="wrapper">
    <div class="registerCon">
        <ul>
            <li>
                <s class="password"></s>
                <input type="password" id="verifcode" placeholder="6-16位数字、字母组成" value="" maxlength="26" />
                <span class="clear">x</span>
            </li>
            <li><a id="findPasswordNextBtn" href="javascript:void(0);" class="orangeBtn">确认重置</a></li>
        </ul>
    </div>

</div>

<script src="layui/layui.js"></script>
<script>
    layui.use(['layer', 'laypage', 'element'], function(){
        var layer = layui.layer
            ,laypage = layui.laypage
            ,element = layui.element();
    })
</script>
<script>




    function resetpwd(){
        // 密码失去焦点
        $('#verifcode').blur(function(){
            reg=/^[0-9A-Za-z]{6,16}$/;
            var that = $(this);
            if( that.val()==""|| that.val()=="6-16位数字、字母组成"){
                layer.msg('请重置密码！');
            }else if(!reg.test(that.val())){
                layer.msg('请输入6-16位数字、字母组成的密码！');
            }
        })

    }
    resetpwd();



    $('.registerCon input').bind('keydown',function(){
        var that = $(this);
        if(that.val().trim()!=""){

            that.siblings('span.clear').show();
            that.siblings('span.clear').click(function(){
                that.val("");
                $(this).hide();
            })

        }else{
            that.siblings('span.clear').hide();
        }

    })
    // function show(){
    //     if($('.registerCon input').attr('type')=='password'){
    //         $(this).prev().prev().val($("#passwd").val());
    //     }
    // }
    // function hide(){
    //     if($('.registerCon input').attr('type')=='text'){
    //         $(this).prev().prev().val($("#passwd").val());
    //     }
    // }
    // $('.registerCon s').bind({click:function(){
    //     if($(this).hasClass('eye')){
    //         $(this).removeClass('eye').addClass('eyeclose');

    //         $(this).prev().prev().prev().val($(this).prev().prev().val());
    //         $(this).prev().prev().prev().show();
    //         $(this).prev().prev().hide();


    //     }else{
    //             console.log($(this  ));
    //             $(this).removeClass('eyeclose').addClass('eye');
    //             $(this).prev().prev().val($(this).prev().prev().prev().val());
    //             $(this).prev().prev().show();
    //             $(this).prev().prev().prev().hide();

    //          }
    //      }
    //  })
</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>信息流 - 滚动加载</legend>
</fieldset>

<ul class="flow-default" id="LAY_demo1"></ul>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
    <legend>信息流 - 手工加载</legend>
</fieldset>

<ul class="flow-default" style="height: 300px;" id="LAY_demo2"></ul>






<script src="//res.layui.com/layui/dist/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use('flow', function(){
        var flow = layui.flow;

        flow.load({
            elem: '#LAY_demo1' //流加载容器
            ,scrollElem: '#LAY_demo1' //滚动条所在元素，一般不用填，此处只是演示需要。
            ,done: function(page, next){ //执行下一页的回调

                //模拟数据插入
                setTimeout(function(){
                    var lis = [];
                    for(var i = 0; i < 8; i++){
                        lis.push('<li>'+ ( (page-1)*8 + i + 1 ) +'</li>')
                    }

                    //执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
                    //pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
                    next(lis.join(''), page < 10); //假设总页数为 10
                }, 500);
            }
        });

        flow.load({
            elem: '#LAY_demo2' //流加载容器
            ,scrollElem: '#LAY_demo2' //滚动条所在元素，一般不用填，此处只是演示需要。
            ,isAuto: false
            ,isLazyimg: true
            ,done: function(page, next){ //加载下一页
                //模拟插入
                setTimeout(function(){
                    var lis = [];
                    for(var i = 0; i < 6; i++){
                        lis.push('<li><img lay-src="//s17.mogucdn.com/p2/161011/upload_279h87jbc9l0hkl54djjjh42dc7i1_800x480.jpg?v='+ ( (page-1)*6 + i + 1 ) +'"></li>')
                    }
                    next(lis.join(''), page < 6); //假设总页数为 6
                }, 500);
            }
        });



    });
</script>

</body>
</html>