<?php

class MailController extends Yaf_Controller_Abstract{
	
	public function indexAction(){
		echo 'mail/index';
		return false;
	}
    
    	
	public function sendAction(){
	
		// 验证提交路径

		// 获取参数
		
		$uid = $this->getRequest()->getPost('uid',false);
		$title = $this->getRequest()->getPost('title',false);
		$contents = $this->getRequest()->getPost('contents', false);
		if(!$uid || !$title || !$contents){
			echo json_encode(array(
				'errno'=>-3001,
				'errmsg'=>'用户id,邮件标题,邮件内容不能为空'
			));
			return false;
		}
		
		// 调用Model 发送邮件
		$model = new MailModel();
		$model->send($uid,$title,$contents);
		echo json_encode(array(
			'errno'=>$model->errno,
			'errmsg'=>$model->errmsg
		));
		return false;
	}
		
}
