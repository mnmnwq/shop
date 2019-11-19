<?php
namespace app\index\controller;
use think\Controller;
use app\model\ShopGoods;
class Goods extends Controller{
	/**
	 * 商品详情
	 * @return [type] [description]
	 */
	public function goods_detail(){
		$goods_id = input('goods_id','0');
		//查询商品信息
		$goods_info = ShopGoods::where(['id'=>$goods_id])->select();
		//dump($goods_info);
		return view('detail');
	}
}