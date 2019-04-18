<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>填写收货地址</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/writeaddr.css">
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="dist/css/LArea.css">
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a  class="m-index-icon">修改</a>
</div>
<div class=""></div>
<!-- <form class="layui-form" action="">
  <input type="checkbox" name="xxx" lay-skin="switch">

</form> -->
<form class="layui-form" action="">

    <div class="addrcon">

        <ul>
            <li><em></em><input class="demo" name='id' type="hidden"  value="{{$data->address_id}}"></li>

            <li><em>收货人</em><input id="name" type="text" placeholder="请填写真实姓名" value="{{$data->address_name}}"></li>
            <li><em>手机号码</em><input id="tel" type="number" placeholder="请输入手机号" value="{{$data->address_tel}}"></li>
            <li><em>所在区域</em><input id="demo1" type="text"  name="input_area" placeholder="请选择所在区域" value="{{$data->province}}"></li>
            <li class="addr-detail"><em>详细地址</em><input id="ads" type="text" placeholder="20个字以内" class="addr" value="{{$data->address_detail}}"></li>
        </ul>

        <div class="setnormal"><span>设为默认地址</span><input type="checkbox" name="xxx" lay-skin="switch">  </div>
    </div>

</form>

<!-- SUI mobile -->
<script src="dist/js/LArea.js"></script>
<script src="dist/js/LAreaData1.js"></script>
<script src="dist/js/LAreaData2.js"></script>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="layui/layui.js"></script>

<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form();

        // //监听提交
        // form.on('submit(formDemo)', function(data){
        //     layer.msg(JSON.stringify(data.field));
        //     return false;
        // });
        $('.m-index-icon').click(function(){
            var data = {};//json数据格式
            var address_id=$('.demo').val();
            //console.log('demo');
            var name=$('#name').val();
            // console.log(name);
            var tel=$('#tel').val();
            // console.log(tel);
            var addres=$('#demo1').val();
            var ads=$('#ads').val();
            var m=$('.setnormal').val();
            data.name=name;
            data.tel=tel;
            data.addres=addres;
            data.ads=ads;
            data.m=m;
            data.address_id=address_id;
            var url = "edit";
            $.ajax({
                type: "post",
                data: data,
                dataType: "json",
                url: url,
                success: function (msg) {
                    if(msg.statua==0){
                        layer.msg(msg.msg);
                    }else{
                        layer.msg(msg.msg);
                        location.href="ord";
                    }
                }
            })
        })
    });
    var area = new LArea();
    area.init({
        'trigger': '#demo1',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置
        'valueTo':'#value1',//选择完毕后id属性输出到该位置
        'keys':{id:'id',name:'name'},//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
        'type':1,//数据源类型
        'data':LAreaData//数据源
    });


</script>


</body>
</html>