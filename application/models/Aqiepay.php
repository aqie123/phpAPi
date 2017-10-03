<?php

// 微信支付模型

$wxpayLibPath = dirname(__FILE__).'/../library/ThirdParty/Wxpay/';
include_once($wxpayLibPath.'WxPay.Api.php');
include_once($wxpayLibPath.'WxPay.Notify.php');
include_once($wxpayLibPath.'WxPay.NativePay.php');
include_once($wxpayLibPath.'WxPay.Data.php');

class AqiepayModel extends WxPayNotify{
	public $errno = 0;
	public $errmsg = '';
	private $_db;

	public function __construct(){
		$this->_db = new PDO('mysql:host=127.0.0.1;dbname=test;','root','root');
	}
	public function aqie(){
		return 666;
	}

	public function createbill($itemId, $uid){
		//验证商品是否存在,是否过期,库存是否充足(商品表 item id关联 bill表 itemid)

		$query = $this->_db->prepare('select * from `item` where id = ?');
		$query->execute(array($itemId));
		$ret = $query->fetch(PDO::FETCH_ASSOC);
		if(!$ret){
			$this->errno = -6003;
			$this->errmsg = '找不到该商品';
			return false;
		}


		if(strtotime($ret['etime']) <= time()){
			$this->errno = -6004;
			$this->errmsg = '商品过期，不能购买';
			return false;
		}

		if(intval($ret['stock']) <= 0){
			$this->errno = -6005;
			$this->errmsg = '商品库存不足,无法购买';
			return false;
		}

		// 创建订单bill
		$query = $this->_db->prepare('insert into bill(itemid,uid,price,status) values(?,?,?,"unpaid")');
		$res = $query->execute(array($itemId,$uid,$ret['price']));
		// $query->debugDumpParams();
		if(!$res){
			$this->errno = -6006;
			$this->errmsg = '创建订单失败';
			return false;
		}

		$lastId = intval($this->_db->lastInsertId());

		// 减库存
		$query = $this->_db->prepare('update item set stock=stock-1 where id = ?');
		$ret = $query->execute(array($itemId));
		if(!$ret){
			$this->errno = -6006;
			$this->errmsg = '更新库存失败';
			return false;
		}

		return $lastId;


	}

	// 生成二维码链接
	public function qrcode($billId){
		// 判断账单是否存在
		$query = $this->_db->prepare('select * from bill where id = ?');
		$query->execute(array($billId));
		$ret = $query->fetch(PDO::FETCH_ASSOC);
		if(!$ret){
			$this->errno = -6009;
			$this->errmsg = '订单不存在';
			return false;
		}

		// 通过商品关联id查询出商品信息
		$query = $this->_db->prepare('select * from item where id = ?');
		$query->execute(array($ret['itemid']));
		$res = $query->fetch(PDO::FETCH_ASSOC);
		if(!$res){
			$this->errno = -6010;
			$this->errmsg = '商品不存在';
			return false;
		}

		$input = new WxPayUnifiedOrder();
		$input->SetBody($res['gname']);
		$input->SetAttach($billId);
		$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee($res['price']);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 86400*3));
		$input->SetGoods_tag($res['gname']);
		$input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
		$input->SetTrade_type("NATIVE");
		// $input->SetOpenid($openId);
		$input->SetProduct_id($billId);

		$notify = new NativePay();
		$result = $notify->GetPayUrl($input);
		$url = $result['code_url'];
		return $url;
	}

	// 微信回调函数
	public function callback(){
		// todo		
	}
}
