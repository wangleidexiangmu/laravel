<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeixinController extends Controller
{
    public function valid(){
        echo $_GET['echostr'];
    }
    public function accessToken()
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
    public function xmladd(Request $request)
    {
        //echo $request->input('echostr');
        $str = file_get_contents("php://input");
        $objxml = simplexml_load_string($str);
        //var_dump($objxml);
        file_put_contents("/tmp/1809_weixin.log", $str, FILE_APPEND);
        $Event = $objxml->Event;
        $FromUserName = $objxml->FromUserName;
        $ToUserName = $objxml->ToUserName;
        $MsgType = $objxml->MsgType;
        $MediaId = $objxml->MediaId;
        $access = $this->accessToken();
        $userUrl = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access&openid=$FromUserName&lang=zh_CN";
        $userAccessInfo = file_get_contents($userUrl);
        $userInfo = json_decode($userAccessInfo, true);
        //var_dump($userInfo);exit;
        $name = $userInfo['nickname'];
        $sex = $userInfo['sex'];
        $headimgurl = $userInfo['headimgurl'];
        $openid1 = $userInfo['openid'];
        if ($Event == 'subscribe') {
            $data = DB::table('wx')->where('openid', $FromUserName)->count();
            //print_r($data);die;
            if ($data == '0') {
                $weiInfo = [
                    'name' => $name,
                    'sex' => $sex,
                    'img' => $headimgurl,
                    'openid' => $openid1,
                    'time' => time()
                ];
                DB::table('wx')->insert($weiInfo);
                //回复消息
                $time = time();
                $content = "关注本公众号成功";
                $xmlStr = "
                   <xml>
                        <ToUserName><![CDATA[$FromUserName]]></ToUserName>
                        <FromUserName><![CDATA[$ToUserName]]></FromUserName>
                        <CreateTime>$time</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[$content]]></Content>
                   </xml>";
                echo $xmlStr;
            }else{
                $time = time();
                $content = "欢迎" . $name . "回来";
                $xmlStr = "
                   <xml>
                        <ToUserName><![CDATA[$FromUserName]]></ToUserName>
                        <FromUserName><![CDATA[$ToUserName]]></FromUserName>
                        <CreateTime>$time</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[$content]]></Content>
                   </xml>";
                echo $xmlStr;
            }
        }

    }
    /**自定义菜单添加*/
    public function createadd(Request $request){
        $access = $this->accessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access";
        $arr =[
            "button"=>[
                [
                    "type"=>"click",
                    "name"=>"客服",
                    "key"=>"V1001_TODAY_MUSIC01"
                ],
               "button"=>[
                   [

                       "name"=>"菜单",
                      "button"=>[
                         [
                             "type"=>"view",
                               "name"=>"搜索",
                               "url"=>"http://www.soso.com/"
                         ]
                      ],
                       "button"=>[
                           [
                               "type"=>"location",
                               "name"=>"跳转",
                               "url"=>"http://www.baidu.com/"
                           ]
                       ],
                       "button"=>[
                           [
                               "type"=>"select",
                               "name"=>"查询",
                               "url"=>"http://www.baidu.com/"
                           ]
                       ],
                   ],
               ],
            ] ,
        ];
        $strJson = json_encode($arr,JSON_UNESCAPED_UNICODE);
        $objurl = new Client();
        $response = $objurl->request('POST',$url,[
            'body' => $strJson
        ]);
        $res_str = $response->getBody();
        //var_dump($res_str);
        return $res_str;
    }
}
