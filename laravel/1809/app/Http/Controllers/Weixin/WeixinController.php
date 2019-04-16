<?php

namespace App\Http\Controllers\Weixin;
use   Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use  App\model\weixin\weixin;
use  App\model\weixin\txt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
class WeixinController extends Controller
{
    public function valid(){
        echo $_GET['echostr'];
    }

    public function wxEvent()
    {
        //接收微信服务器推送
        $content = file_get_contents("php://input");
        $time = date('Y-m-d H:i:s');
        $str = $time . $content . "\n";
        file_put_contents("logs/wx_event.log",$str,FILE_APPEND);
        // var_dump($content);exit;
        $data = simplexml_load_string($content);
        //$data = (array)simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);
        // var_dump($data);exit;
        $type=$data->MsgType;
        //var_dump($type);exit;



        $wx_id = $data->ToUserName;// 公众号ID
        $openid = $data->FromUserName;//用户OpenID
        $event = $data->Event;//事件类型
        if($event=='subscribe'){        //扫码关注事件
            //根据openid判断用户是否已存在
            $local_user = weixin::where(['openid'=>$openid])->first();
            if($local_user){
                //用户之前关注过
                echo '
                    <xml>
                    <ToUserName><![CDATA['.$openid.']]></ToUserName>
                    <FromUserName><![CDATA['.$wx_id.']]></FromUserName>
                    <CreateTime>'.time().'</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA['. '欢迎回来 '. $local_user['nickname'] .']]></Content>
                    </xml>';
            }else{          //用户首次关注
                //获取用户信息
                $u = $this->getUserInfo($openid);
                //用户信息入库
                $u_info = [
                    'openid'    => $u['openid'],
                    'nickname'  => $u['nickname'],
                    'sex'  => $u['sex'],
                    'headimgurl'  => $u['headimgurl'],
                ];
                $id = weixin::insertGetId($u_info);
                echo '
                    <xml>
                    <ToUserName><![CDATA['.$openid.']]></ToUserName>
                    <FromUserName><![CDATA['.$wx_id.']]></FromUserName>
                    <CreateTime>'.time().'</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA['. '欢迎关注 '. $u['nickname'] .']]></Content>
                    </xml>';
            }
        }


        if($type=='text'){
            $txt=$data->Content;//文本信息
            // var_dump($txt);exit;
            $addtime=$data->CreateTime;//时间
            file_put_contents("logs/txt.log", $str, FILE_APPEND);
            $openid = $data->FromUserName;
            //$u=$this->getUserInfo($openid);
            $info=[
                'openid'=>$openid,
                'text'=>$txt,
                'createtime'=>$addtime,
            ];
            $txtinfo=txt::insert($info);
            //  var_dump($txtinfo);exit;
            if(strpos($txt,'天气')){
               // $res=json_encode($txt);
             // echo $res;
                $city=explode('天',$txt)[0];
                //echo $city;
                $url='https://free-api.heweather.net/s6/weather/now?key=HE1904161219291607&location='.$city.'';
               // echo $url;exit;
                $arr=file_get_contents($url);
               //var_dump($arr) ;exit;
                $res=json_decode($arr,true);
               // echo print_r($res);exit;
                $results=$res['HeWeather6']['0']['status'];
                if($results=='ok'){
                    $sun=$res['HeWeather6']['0']['now']['cond_txt'];
                    $tmp=$res['HeWeather6']['0']['now']['tmp'];
                    $wind_dir=$res['HeWeather6']['0']['now']['wind_dir'];
                    $wind_sc=$res['HeWeather6']['0']['now']['wind_sc'];
                    $str="温度：".$tmp."\n"."天气：".$sun."\n"."风向：".$wind_dir."\n"."风力".$wind_sc."\n";
                    $today='<xml>
<ToUserName><![CDATA['.$openid.']]></ToUserName>
<FromUserName><![CDATA['.$wx_id.']]></FromUserName>
<CreateTime>'.time().'</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA['.$str.']]></Content>
</xml>';
                    echo $today;
                }else{
                    echo '<xml>
<ToUserName><![CDATA['.$openid.']]></ToUserName>
<FromUserName><![CDATA['.$wx_id.']]></FromUserName>
<CreateTime>'.time().'</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA['.输入城市错误.']]></Content>
</xml>';
                }



            }
        }else if($type=='image'){
            $MediaId=$data->MediaId;//
            $access = $this->getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access&media_id=$MediaId";
            $time = time();
            $res_str = file_get_contents($url);
            //echo $res_str;
            file_put_contents("logs/image/$time.jpg", $res_str, FILE_APPEND);
        }else if($type=='voice'){
            $MediaId=$data->MediaId;//
            $access =  $this->getAccessToken();
            $vourl = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access&media_id=$MediaId";
            //var_dump($vourl);ecit;
            $votime = time();
            $res_str = file_get_contents($vourl);
           // echo $res_str;
            $res=file_put_contents("logs/voice/$votime.mp3", $res_str, FILE_APPEND);
          // echo  $array=json_decode($res);
            //var_dump($res);
        }

    }
    public function getAccessToken()
    {
        //Cache::pull('access');exit;
        $access = Cache('access');
        if (empty($access)) {
            $appid = "wxe750a38a8fe84b93";
            $appkey = "f483a2d1affda7dea1231f5ccb70eb0f";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appkey";
            $info = file_get_contents($url);
            $arrInfo = json_decode($info, true);
            $key = "access";
            $access = $arrInfo['access_token'];
            $time = $arrInfo['expires_in'];
            cache([$key => $access], $time);
        }
        return $access;
    }
    //测试
    public function test()
    {
        $access_token = $this->getAccessToken();
        echo 'token : '. $access_token;echo '</br>';
    }
    //获取微信用户信息
    public function getUserInfo($openid)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->getAccessToken().'&openid='.$openid.'&lang=zh_CN';
        $data = file_get_contents($url);
        $u = json_decode($data,true);
        return $u;
    }
    //微信菜单
    public function card(){
        $res='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->getAccessToken().'';
        $arrInfo =[
            "button"=>[
                [
                    "type"=>"click",
                    "name"=>"客服",
                    "key"=>"V1001_TODAY_MUSIC01"
                ],
                [
                    "type"=>"click",
                    "name"=>"其他",
                    "key"=>"V1001_TODAY_MUSIC02"
                ],
            ] ,
        ];


        $data=json_encode($arrInfo,JSON_UNESCAPED_UNICODE);//处理中文编码
        //发送请求
        $clinet= new Client();
        //发送json字符串
        $response=$clinet->request('POST',$res,[
            'body'=>$data
        ]);
        //处理相应
        $reslut=$response->getBody();
        //转数组
        $arr = json_decode($reslut,true);
        //判断错误信息
        if($arr['errcode']>0){

            echo "创建菜单失败";
        }else{
            echo "创建菜单成功";
        }

    }
    public function allsend($openid_arr,$content){
            $msg=[
                "touser"=>$openid_arr,
                "msgtype"=>"text",
                "text"=>[
                    "content"=>$content
                ]
            ];
            $data=json_encode($msg,JSON_UNESCAPED_UNICODE);
           // echo $data;
        $url='https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$this->getAccessToken().'';
        $clinet= new Client();
        //发送json字符串
       $response= $clinet->request('POST',$url,[
            'body'=>$data
        ]);
       return $response->getBody();

    }
        public function send(){
                $userlist=weixin::where(['sub_status'=>1])->get()->toarray();
                //var_dump($userlist);
            $openid_arr=array_column($userlist,'openid');
            $msg="彩蛋来了";
            $result=$this->allsend($openid_arr,$msg);
            echo $result;
        }

}
