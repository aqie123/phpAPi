<?php

/**
 * 邮件发送类
 *
 */

require __DIR__.'/../../vendor/autoload.php';
use Nette\Mail\Message;

class MailModel{

	public $errno;
	public $errmsg;
	private $_db;

	public function __construct(){
		$this->_db = new PDO('mysql:host=127.0.0.1;dbname=test;','root','root');
	}
	
	public function send($uid,$title,$contents){
		// 连接数据库，查找用户邮箱信息
		$query = $this->_db->prepare('select email from auth_admin where admin_id = ?');
		$query->execute(array(intval($uid)));
	    //	$query->debugDumpParams();
		$ret = $query->fetch(PDO::FETCH_ASSOC);
		if(!$ret){
			$this->errno=-3001;
			$this->errmsg='用户邮箱信息查找失败';
			return false;
		}

		// 验证邮箱是否符合标准
		$userEmail = $ret['email'];
		if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
			$this->errno = -3004;
			$this->errmsg = '用户邮箱不符合标准:'.$userEmail;
			return false;
		}else{
			$this->errno = 0;
			$this->errmsg = '邮件发送成功';
		}

		$mail = new Message;
		$mail->setFrom('aqie123aqie@163.com')
			->addTo($userEmail)
			->setSubject($title)
			->setBody($contents);

		$mailer = new Nette\Mail\SmtpMailer([
			'host'=>'smtp.163.com',
			'username'=>'aqie123aqie@163.com',
			'password'=>'aqie123aqie',
			'secure'=>'ssl'
		]);
		$rep = $mailer->send($mail);
        return false;
	}
}
