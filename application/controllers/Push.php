<?php

// 推送服务接口

class PushController extends Yaf_Controller_Abstract{

	// 单独推送
	public function singleAction(){
		// 验证是否是管理员

		// 接收参数 cid = af7d325709c88542e4e6e9b884d5e0fa
		$cid = $this->getRequest()->getPost('cid', '');
		$msg = $this->getRequest()->getPost('msg','');

		// 验证数据是否合法
		
		// 调用model
		$model = new PushModel();
		$model->single($cid,$msg);
		echo json_encode(array(
			'errno'=>$model->errno,
			'errmsg'=>$model->errmsg
		));

		return false;
	}

	public function indexAction(){
		echo 'push/index';
		return false;
	}

	public function toAllAction(){
		$msg = $this->getRequest()->getPost('msg','');

		// 验证数据是否合法
		
		// 调用model
		$model = new PushModel();
		$model->toAll($msg);
		echo json_encode(array(
			'errno'=>$model->errno,
			'errmsg'=>$model->errmsg
		));

		return false;
		
	}
}
