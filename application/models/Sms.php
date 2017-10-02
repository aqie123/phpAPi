<?php

class SmsModel{
	
	public $errno = 0;
	public $errmsg = '';
	private $_db;	
	public function __construct(){
		$this->_db = new PDO('mysql:host=127.0.0.1;dbname=test;','root','root');
	}

	// 测试短信发送结果记录到数据库
	public function test(){
		$uid = 1;
		$contentParam = array('code'=>rand(1000,9999));
		$template = '10018';
		$query = $this->_db->prepare('insert into sms_record(uid,contents,template) values(?,?,?)');
		$query->debugDumpParams();
		$contentParam = json_encode($contentParam);
		$ret = $query->execute(array(
			$uid,
			$contentParam,
			$template
		));
		if(!$ret){
			$this->errno = -4006;
			$this->errmsg = '消息发送成功，记录失败';
			return false;
		}
	}

	// 批量发送短信
	public function sendAll(){
		// 从数据库中选中所有用户手机号,调用send方法
		
	}

	// 单一用户发送短信
	public function send($uid, $contents){
		
		// 判断用户信息是否存在
		$query = $this->_db->prepare('select mobile from auth_admin where admin_id = ?');
		$query->execute(array(intval($uid)));
		$ret = $query->fetch(PDO::FETCH_ASSOC);
		if(!$ret){
			$this->errno=-3001;
			$this->errmsg='用户电话号码信息查找失败';
			return false;
		}

		$userMobile = $ret['mobile'];
		// 对手机号进行验证
		if(!$userMobile || !is_numeric($userMobile) || strlen($userMobile)!=11){
			$this->errno = -4004;
			$this->errmsg = '用户手机号码不符合标准,手机号:'.(!$userMobile?'空':$userMobile);
			return false;
		}
		
		// 云信用户名密码
		$smsUid = 'aqie';
		$smsPwd = 'phpapi123';
		$sms = new ThirdParty_Sms($smsUid, $smsPwd);

		$contentParam = array('code'=>rand(1000,9999));
		$template = '100006';
		$result = $sms->send($userMobile, $contentParam, $template);

		if($result['stat'] == '100'){
			// 记录短信发送状态 (表 sms_record)
			$query = $this->_db->prepare('insert into sms_record(uid,contents,template) values(?,?,?)');
			$ret = $query->execute(array(
				$uid,
				json_encode($contentParam),
				$template
			));
			if(!$ret){
				$this->errno = -4006;
				$this->errmsg = '消息发送成功，记录失败';
				return false;
			}
			return true;
		}else{
			$this->errno = -4005;
			$this->errmsg = '发送失败:'.$result['stat'].'('.$result['message'].')';
			return false;
		}
		
	}
}


