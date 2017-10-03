<?php

// 微信支付功能封装

$qrcodeLibPath = dirname(__FILE__).'/../library/ThirdParty/Qrcode/';
include_once($qrcodeLibPath.'Qrcode.php');

class WxpayController extends Yaf_Controller_Abstract{
	
	public function indexAction(){
		echo 'Wxpay/index';	
	   // $model = new WxpayModel()；
		 $model = new AqiepayModel();
		$ret = $model->aqie();
		echo $ret;
	 	
		return false;	
	}

	public function createbillAction(){
		// 商品相关
		// 接收商品相关参数
		$itemid = $this->getRequest()->getPost('itemid','');
		// 判断商品id是否存在
		if(!$itemid){
			echo json_encode(array(
				'errno'=>-6001,
				'errmsg'=>'请传递正确商品id'
			));
			return false;
		}	

		// 检查用户是否登录
		session_start();
		if(!isset($_SESSION['user_token_time']) || !isset($_SESSION['user_token']) || !isset($_SESSION['user_id']) || md5('salt'.$_SESSION['user_token_time'].$_SESSION['user_id']) != $_SESSION['user_token']){
			echo json_encode(array(
				'errno'=>-6002,
				'errmsg'=>'请先登录再操作'
			));
			return false;
		}else{
			//  echo '登陆成功';
			// var_dump($_SESSION);
		}
		

		// 调用model
		$model = new AqiepayModel();
			// 返回订单id
		
		$data = $model->createbill($itemid, $_SESSION['user_id']);
		echo json_encode(array(
			'errno'=>$model->errno,
			'errmsg'=>$model->errmsg,
			'data'=>$data
		));

		return false;
	}

	// 生成二维码
	public function qrcodeAction(){
		// 订单相关
		$billId = $this->getRequest()->getPost('billid','');
		
		if(!$billId){
			echo json_encode(array(
				'errno'=>-6008,
				'errmsg'=>'请传递正确订单id'
			));
			return false;
		}
		
		// 调用model输出二维码
		$model = new AqiepayModel();

		// data 返回的是code url
		if($data = $model->qrcode($billId)){
			QRcode::png($data);
		}else{
			echo json_encode(array(
				'errno'=>$model->errno,
				'errmsg'=>$model->errmsg
			));
		}

		return false;
	}

	public function callbackAction(){
		//微信回调
		$model = new AqiepayModel();
		$model->callback();
		echo json_encode(array(
			'errno'=>0,
			'errmsg'=>''
		));

		return false;
	}



}
