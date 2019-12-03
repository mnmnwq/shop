<?php
namespace app\admin\controller;
use app\model\ShopBrand;
use app\model\ShopCate;
use app\model\ShopGoods;
class Goods extends Common{
	/**
	 * 商品主页
	 * @return [type] [description]
	 */
	public function index(){
	    $goods_info = ShopGoods::leftJoin('shop_cate','shop_cate.id=shop_goods.cate_id')
            ->leftJoin('shop_brand','shop_brand.id=shop_goods.brand_id')
            ->paginate(5);
	    return view('index',['goods_info'=>$goods_info]);
    }

	/**
	 * 添加商品
	 */
	public function add(){
		$brand_info = ShopBrand::select();
		$cate_info = ShopCate::select();
		$cate = createTree($cate_info); //调用无限极分类公共函数
		return view('add',['brand_info'=>$brand_info,'cate'=>$cate]);
	}
	/**
	 * 执行添加商品
	 * @return [type] [description]
	 */
	public function do_add(){
		$file = request()->file('goods_pic'); //单文件上传
		$files = request()->file('goods_images');//多文件上传
		//单文件上传
		$file_result = $file->move('./uploads/goods');
		if(!$file_result){
			$this->error('文件上传失败');
		}
		$goods_pic = '/uploads/goods/'.$file_result->getSaveName();

		 //多文件上传	
		$images = [];
		foreach ($files as $v) {
			$result = $v->move('./uploads/goods');
			if(!$result){
				$this->error('文件上传失败');
			}
			$images[] = '/uploads/goods/'.$result->getSaveName();
		}
		//往表添加数据，左边是字段名称，右边是表单数据
		$shop_goods = new ShopGoods;
		$shop_goods->goods_name = input('goods_name','');
		$shop_goods->simple_desc = input('goods_simple','');
		$shop_goods->goods_price = input('goods_price','0');
		$shop_goods->goods_pic = $goods_pic;
		$shop_goods->goods_images = implode('|',$images);
		$shop_goods->desc = input('desc','');
		$shop_goods->is_hot = input('is_hot','0');
		$shop_goods->is_new = input('is_new','0');
		$shop_goods->is_up = input('is_up','0');
		$shop_goods->cate_id = input('cate_id','0');
		$shop_goods->brand_id = input('brand_id','0');
		$shop_goods->add_time = time();
		//执行添加操作
		$add_result = $shop_goods->save();
		if($add_result){
			$this->success('成功');
		}else{
			$this->error('失败');
		}
		
	}
}
