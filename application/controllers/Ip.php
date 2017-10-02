<?php

// 获取ip归属地

class IpController extends Yaf_Controller_Abstract{
	
	public function indexAction(){
		echo 'ip/index';
		return false;
	}

	// 获取ip归属地
	public function getIpAction(){
		$ip = $this->getRequest()->getPost('ip','');
		// php内置方法
		if(!$ip || !filter_var($ip, FILTER_VALIDATE_IP)){
			echo json_encode(array(
				'errno'=>-5001,
				'errmsg'=>'请传递正确的IP地址'
			));
		    return false;
		}

		// 调用model 查询IP归属地
		$model = new IpModel();
		$data = $model->getIp(trim($ip));
		echo json_encode(array(
			'errno'=>$model->errno,
			'errmsg'=>$model->errmsg,
			'data'=>$data
		));

		// todo ?
		return false;
	}
}
