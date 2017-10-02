<?php

// 短信处理

class SmsController extends Yaf_Controller_Abstract{

	// 
	public function indexAction(){
		echo 'Sms/index';
		$model = new SmsModel();
		$model->test();
		
		echo json_encode(array(
			'errno'=>$model->errno,
			'errmsg'=>$model->errmsg
		));
		return false;
	}

	// 群发短信
	public function sendAll(){
		$modle = new SmsModel();
		$model->sendAll();
	}

	// 指定用户 发送短信
	public function sendAction(){
		// 获取参数
		$uid = $this->getRequest()->getPost('uid',false);
		$contents = $this->getRequest()->getPost('contents', false);
		if(!$uid || !$contents){
			echo json_encode(array(
				'errno'=>-4001,
				'errmsg'=>'用户id，短信内容不能为空'
			));
			return false;
		}
	    
		$model = new SmsModel();
		
		if($model->send(intval($uid),trim($contents))){
			echo json_encode(array(
				'errno'=>0,
				'errmsg'=>''
			));
		}else{
			echo json_encode(array(
				'errno'=>$model->errno,
				'errmsg'=>$model->errmsg
			));
		}
		return false;	
	}
}
