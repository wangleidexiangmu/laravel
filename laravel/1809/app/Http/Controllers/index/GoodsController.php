<?php

namespace App\Http\Controllers\index;
use App\model\index\shop_cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class GoodsController extends Controller{
    public function goods(){
        return view('goods.goods');
    }
    public function cate(){
        $cate=DB::table('shop_category')->where('pid',0)->get();
           // $info=DB::table('shop_category')->get();
       // var_dump($cate);exit;
       $arr=DB::table('shop_category')->get();

       // var_dump($arr);exit;
        $data=json_encode($arr);
        $data=json_decode($data,true);
        //处理分类信息
       $dataInfo= $this->getCateInfo($data);
       //print_r($dataInfo);exit;
      return view('goods.goods',['cate'=>$cate,'dataInfo'=>$dataInfo]);
    }
    public function meet(){
        $goods=DB::table('shop_goods')->get();
        return view('goods.showlist',['goods'=>$goods]);
    }

//处理分类信息
   public function getCateInfo($data,$pid=0,$level=1){
        static $info=[];
        if($data){
            foreach($data as $k=>$v){
                if($v['pid']==$pid){
                    $v['level']=$level;
                    $info[]=$v;
                    $this->getCateInfo($data,$v['cate_id'],$v['level']+1);// 1 2 3 4
                }
            }
            return $info;
        }


       return $info;

    }
    public function loadend(Request $request){
        $arr=array();
        $page=$request->input('page');
        $pageNum=10;
        $offset=($page-1)*$pageNum;
        // var_dump($res);exit;
        $cate_id=$request->input('cate_id');
      //  var_dump($cate_id);exit;
        if(empty($cate_id)){
            $arrDataInfo=DB::table('shop_goods')->offset($offset)->limit($pageNum)->get();
            $totalData=DB::table('shop_goods')->count();
        }else{
            $data=DB::table('shop_category')->get()->toArray();
            //return $data;
//            $data=json_encode($data);
//            $data=json_decode($data);
            $ids = $this->getCateId($data,$cate_id);
            array_push($ids,$cate_id);
            $arrDataInfo=DB::table("shop_goods")->offset($offset)->limit($pageNum)->whereIn('cate_id',$ids)->get();//每页的数据
            $totalData=DB::table("shop_goods")->whereIn('cate_id',$ids)->count();//总条数
        }

        $pageTotal=ceil($totalData/$pageNum);//总页数
        $objview=view("goods.showlist",['info'=>$arrDataInfo]);
        $countent=response($objview)->getContent();
        $arr['info']=$countent;
        $arr['pageTotal']=$pageTotal;
        return $arr;
    }
    //递归
    public function getCateId($newData,$parent_id){

        static $data;
        if($newData){
            foreach($newData as $k=>$v){
                if($v->pid==$parent_id){
                    $data[$k]=$v->cate_id;

                    $this->getCateId($newData,$v->cate_id);
                }
            }
        }
        return $data;
    }



//商品详情
public function shop(Request $request){
    $arr=$request->input('goods_id');
    $data= DB::table('shop_cart')->count();
   // var_dump($data);exit;
   $res=DB::table('shop_goods')->where('goods_id',$arr)->get();
  // var_dump($res);exit;
    return view('goods.shop',['res'=>$res,'data'=>$data]);
}
//购物车
public function cut(Request $request){
    $res=$request->input('goods_id');
    $sql="select *from shop_goods where goods_id=$res and goods_up=1 and goods_num>0";
    $data= DB::select($sql);
  // var_dump($data);exit;
    $sesson=$request->session()->get('user_id');
// var_dump($sesson);exit;
    if(empty($sesson)){
       $arr=array(
           'status'=>0,
           'msg'=>'请先登录',

       );

       return $arr;
    }
if(empty($data)){
        $arr=array(
            'status'=>0,
            'msg'=>'库存不足'
        );
        return $arr;
}

    $sql="select * from shop_cart where goods_id=$res and user_id=$sesson";
        $cut=DB::select($sql);
       // var_dump($cut);exit;
    if(!empty($cut)){

        $sql="select buy_number from shop_cart where goods_id=$res and user_id=$sesson";
        $num=DB::select($sql);
        $num=json_encode($num);
        $num=json_decode($num,true);
        foreach ($num as $v){
            $val=$v['buy_number'];
        }

       $buy_number=$val+1;
        $time=time();
        $sql="update  shop_cart set buy_number=$buy_number,utime =$time where goods_id=$res and user_id=$sesson";
        $upd=DB::update($sql);
        //var_dump($upd);exit;
        if($upd==0){
            $arr=array(

                'status'=>0,
                'msg'=>'加入失败'

            );
            return $arr;
        }else{
            $arr=array(

                'status'=>1,
                'msg'=>'加入成功'

            );
            return $arr;
        }
    }else{
        $buy_num=1;
        $status=1;
        $time=time();
        $sql="insert into shop_cart(goods_id,user_id,buy_number,status,ctime,utime) values($res,$sesson,$buy_num,$status,$time,$time)";
        $result=DB::insert($sql);
        if($result==0){
            $arr=array(

                'status'=>0,
                'msg'=>'加入失败'

            );
            return $arr;
        }else{
            $arr=array(

                'status'=>1,
                'msg'=>'加入成功'

            );
            return $arr;
        }
    }


//var_dump($result);exit;

}
//购物车
public function cart(){

   $sql="select * from shop_cart join  shop_goods on shop_cart.goods_id=shop_goods.goods_id where shop_cart.is_del = 1";
      $data= DB::select($sql);
    $sql="select * from shop_goods where goods_hot=1";
    $res=DB::select($sql);
    return view('goods.cut',['data'=>$data,'res'=>$res]);
}

//修改物品数量
public function crt(Request $request){
    $goods_id=$request->input('goods_id');
    //var_dump($goods_id);exit;
    $sql = "update shop_cart set buy_number = buy_number+1 where goods_id = $goods_id";
    $data = DB::update($sql);
    $res = DB::table('shop_goods')->where(['goods_id'=>$goods_id])->first();
    $goods_num=$res->goods_num;
    //var_dump($goods_num);
    $num = DB::table('shop_cart')->where(['goods_id'=>$goods_id])->first();
    $buy_number=$num->buy_number;
    //var_dump($buy_number);exit;
    if($buy_number>$goods_num){
        return array('status'=>0,"msg"=>"库存不足");exit;
    }

}
//修改减法
    public function dis(Request $request){
        $goods_id=$request->input('goods_id');
        //var_dump($goods_id);exit;
        $sql = "update shop_cart set buy_number = buy_number-1 where goods_id = $goods_id";
        $data = DB::update($sql);


    }
    //判断库存
    public function data(Request $request){
        $goods_id=$request->input('goods_id');
        $text=$request->input('text');
        $res = DB::table('shop_goods')->where(['goods_id'=>$goods_id])->first();

        $goods_num=$res->goods_num;
       if($goods_num<$text){
           return array('status'=>0,"msg"=>"库存不足");exit;
       }else if($text<0) {
           return array('status' => 0, "msg" => "请输入正确购买数量");
           exit;


       }else{
           $sql = "update shop_cart set buy_number = $text where goods_id = $goods_id";
           $data = DB::update($sql);
          // var_dump($data);exit;
           return array('status'=>1,"msg"=>"修改成功");
       }

    }
    //删除
    public function delect(Request $request){
        $goods_id=$request->input('goods_id');
        //var_dump($goods_id);exit;
        $sql = "update shop_cart set is_del = 2 where goods_id = $goods_id";
        $data=DB::update($sql);
        return $data;

    }
    public function set(Request $request){
        $goods_id=$request->input('id');
        //var_dump($goods_id);exit;

        $res=DB::table('shop_cart')->whereIn("goods_id",$goods_id)->update(['is_del'=>2]);
        if($res==0){
            return array('status'=>0,"msg"=>"删除失败");
        }else{
            return array('status'=>1,"msg"=>"删除成功");
        }
    }

    //订单
    public function detil(Request $request){
        $goods_id=$request->input('id');
       // var_dump($goods_id);exit;
        $cart_name=DB::table('shop_cart')->whereIn('goods_id',$goods_id)->first();
        $cart_id=$cart_name->cart_id;
       // var_dump($cart_id);exit;

        $sesson=$request->session()->get('user_id');
        // var_dump($sesson);exit;
        //判断登录
        if(empty($sesson)){
            $arr=array(
                'status'=>0,
                'msg'=>'请先登录',

            );

            return $arr;
        }
        $data=DB::table('shop_cart')->where('is_del',1)->get();
        if(empty($data)){
            $arr=array(
                'status'=>0,
                'msg'=>'请先选择商品',

            );

            return $arr;
        }

        //收货地址
        $addres_id=1;
        //支付状态
        $order_pay=1;
        $pay_type=1;
       $res = DB::table('shop_goods')->whereIn('goods_id',$goods_id)->first();
      $goods_num=$res->goods_num;
       //var_dump($goods_num);
        $num = DB::table('shop_cart')->whereIn('goods_id',$goods_id)->first();
        $buy_number=$num->buy_number;
       $price=$buy_number*$goods_num;//总价格
        //订单号
        $date=date('ymd');
        $user_id=$sesson;
        $order_number='1'.$date.$user_id.rand(1000,9999);
        $order=[
            'order_number'=>$order_number,
            'user_id'=>$user_id,
            'order_amount'=>0,
            'order_score'=>0,
           'pay_type'=>$pay_type,
        ];

        $shop_order=DB::table('shop_order')->insert($order);
       // var_dump($shop_order);exit;

        $id=DB::table('shop_order')->where('user_id',$user_id)->first();
        $order_id=$id->order_id;
       // var_dump($order_id);exit;

        $res=DB::table('shop_cart')->whereIn("goods_id",$goods_id)->update(['is_del'=>2]);


        foreach ($goods_id as $k=>$v){
            $goods=DB::table('shop_goods')->where('goods_id',$v)->first();
            $goods_selfprice=$goods->goods_selfprice;
            $goods_img=$goods->goods_img;
           // var_dump($goods->goods_name );exit;
            $detil=[
                'user_id'=>$user_id,
                'order_id'=>$order_id,
                'goods_id'=>$v,
                'goods_name'=>$goods->goods_name,
                'goods_selfprice'=>$goods_selfprice,
                'goods_img'=>$goods_img,
                'buy_number'=>$buy_number,
            ];
            //var_dump($detil);exit;
            $shop=DB::table('shop_order_detail')->insert($detil);
            //var_dump($res);exit;


        }
        if($shop==true){
            return array('status'=>1,"msg"=>"成功");
        }

       //return view('goods.detil');

    }
    //订单展示
    public function det(){
            $data=DB::table('shop_order_detail')->where('goods_status',1)->get();
            //var_dump($data);exit;
        return view('goods.detil',['data'=>$data]);
    }
    public function order(Request $request){
        $sesson=$request->session()->get('user_id');
       // var_dump($sesson);exit;
        if(empty($sesson)){
            return redirect('login');

        }
        $address=DB::table('shop_address')->where('user_id',$sesson)->first();
        if(empty($address)){
            return redirect('ord');
        }
        $res=DB::table('shop_order_detail')->where('user_id',$sesson)->update(['goods_status'=>2]);
        $check=DB::table('shop_order_detail')->where('goods_status',1)->get();
        if(empty($check)){
            return redirect('cate');
        }

        $ad=DB::table('shop_address')->where('status',2)->first();
        return view('goods.order',['ad'=>$ad]);
    }
    public function ord(){
        $res=DB::table('shop_order_address')->join('shop_address','shop_order_address.user_id','=','shop_address.user_id')->where('is_del',0)->get();
        //var_dump($res);exit;
        return view('goods.adds',['res'=>$res]);
    }
    public function addres(){

        return view('goods.add');
    }
    public function sho(Request $request){
        $res=$request->input();
        $sesson=$request->session()->get('user_id');
        // var_dump($sesson);exit;
        if(empty($sesson)){
            $arr=array(
                'status'=>0,
                'msg'=>'请先登录',

            );

            return $arr;
        }
        $arr=[
            'address_name'=>$res['name'],
            'address_tel'=>$res['tel'],
            'province'=>$res['addres'],
            'address_detail'=>$res['ads'],
            'user_id'=>$sesson,

        ];
        $data=DB::table('shop_address')->insert($arr);
        //var_dump($data);exit;
        if($data==true){
            $arr=array(
                'status'=>1,
                'msg'=>'添加成功',

            );

            return $arr;
        }
    }

    public function editads(Request $request){
        $res=$request->input('address_id');
         //var_dump($res);exit;
        $data=DB::table('shop_address')->where('address_id',$res)->first();
        //var_dump($data);exit;
        return view('goods.edit',['data'=>$data]);

    }
    public function edit(Request $request)
    {
        $res=$request->input();
         //var_dump($res);exit;
        $sesson=$request->session()->get('user_id');
        // var_dump($sesson);exit;

        $arr=[

            'address_name'=>$res['name'],
            'address_tel'=>$res['tel'],
            'province'=>$res['addres'],
            'address_detail'=>$res['ads'],
            'user_id'=>$sesson,

        ];
        $data=DB::table('shop_address')->where('address_id',$res['address_id'])->update($arr);
        //var_dump($data);exit;
        if($data==true){
            $arr=array(
                'status'=>1,
                'msg'=>'修改成功',

            );

            return $arr;
        }
    }
    public function shan(Request $request){
        $address_id=$request->input('address_id');
        //var_dump($address_id);exit;
        $arr=[
            'is_del'=>2
        ];
        $data=DB::table('shop_address')->where('address_id',$address_id)->update($arr);
        //var_dump($data);exit;
        if($data==1){
            $arr=array(
                'status'=>1,
                'msg'=>'删除成功',

            );

            return $arr;
        }
    }
    public function xuan(Request $request){
        $address_id=$request->input('address_id');
        //var_dump($address_id);exit;
        $data=DB::table('shop_address')->where('status',2)->update(['status'=>1]);
        $res=DB::table('shop_address')->where('address_id',$address_id)->update(['status'=>2]);

        if($res==1){
            return redirect('order');
        }
    }
}
