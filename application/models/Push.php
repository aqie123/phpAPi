<?php

// 推送服务模型

// 引入个推
$pushlibPath = dirname(__FILE__).'/../library/ThirdParty/Getui/';

require_once($pushlibPath . 'IGt.Push.php');
require_once($pushlibPath . 'igetui/IGt.AppMessage.php');
require_once($pushlibPath . 'igetui/IGt.APNPayload.php');
require_once($pushlibPath . 'igetui/template/IGt.BaseTemplate.php');
require_once($pushlibPath . 'IGt.Batch.php');
require_once($pushlibPath . 'igetui/utils/AppConditions.php');

define('APPKEY','Ls8P9KcD3j7iB3SPGFSb76');
define('APPID','qIQiUU6ITUAjRAralc6LLA');
define('MASTERSECRET','T4866mMlkz5zj2I1EuKXNA');
define('HOST','http://sdk.open.api.igexin.com/apiex.htm');


class PushModel {

	public $errno = 0;
	public $errmsg = '';
	public function __construct(){
	
		$this->_db = new PDO('mysql:host=127.0.0.1;dbname=test;','root','root');
	}

	// 单个推送
	public function single($cid,$msg='测试内容'){
		$igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
		$template = $this->_IGtTransmissionTemplateDemo($msg);
		//个推信息体
		$message = new IGtSingleMessage();
		$message->set_isOffline(true);//是否离线
		$message->set_offlineExpireTime(3600*12*1000);//离线时间
		$message->set_data($template);//设置推送消息类型
		$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
		$target = new IGtTarget();
		$target->set_appId(APPID);
		$target->set_clientId($cid);

		try{
			$rep = $igt->pushMessageToSingle($message, $target);
		    //	var_dump($rep);
		   //	echo ("<br><br>");
		   $this->errmsg='消息推送成功';
		}catch(RequestException $e){
			$requstId =e.getRequestId();
			$rep = $igt->pushMessageToSingle($message, $target,$requstId);
			var_dump($rep);
			echo ("<br><br>");
		}
	}
	
	// 多个推送
	/*
	public function toList($msg){
		$igt = new IGeTui(HOST, APPKEY, MASTERSECRET);	
		$template = $this->_IGtTransmissionTemplateDemo($msg);
		//个推信息体
		$message = new IGtListMessage();
		$message->set_isOffline(true);//是否离线
		$message->set_offlineExpireTime(3600 * 12 * 1000);//离线时间
		$message->set_data($template);//设置推送消息类型
		$message->set_PushNetWorkType(1);
		$contentId = $igt->getContentId($message,"toList任务别名功能");

		//接收方1
		$target1 = new IGtTarget();
		$target1->set_appId(APPID);
		$target1->set_clientId(CID);
		// $target1->set_alias(Alias);
		$targetList[] = $target1;
		$rep = $igt->pushMessageToList($contentId, $targetList);
		var_dump($rep);
	}
	 */

	// 全部推送接口
	public function toAll($msg){
		$igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
		$template = $this->_IGtTransmissionTemplateDemo($msg);

		// 个推信息体，基于应用消息体
		$message = new IGtAppMessage();
		$message->set_isOffline(true);
		$message->set_offlineExpireTime(10 * 60 * 1000);
		$message->set_data($template);

		$appIdList=array(APPID);
		$phoneTypeList=array('ANDROID');
	    //	$provinceList=array('浙江');
	    //	$tagList=array('haha');

		$cdt = new AppConditions();
		$cdt->addCondition(AppConditions::PHONE_TYPE, $phoneTypeList);
	    //	$cdt->addCondition(AppConditions::REGION, $provinceList);
	    //	$cdt->addCondition(AppConditions::TAG, $tagList);
	    //	$cdt->addCondition("age", $age);

		$message->set_appIdList($appIdList);
	    //	$message->set_conditions($cdt->getCondition());
		$message->condition = $cdt;

		$rep = $igt->pushMessageToApp($message);
		if($rep['result'] == 'ok'){
			$this->errno = 0;
			$this->errmsg = '群体推送成功';
		}
	}

	// 模板
	private function _IGtTransmissionTemplateDemo($msg){
		$template =  new IGtTransmissionTemplate();
		$template->set_appId(APPID);//应用appid
		$template->set_appkey(APPKEY);//应用appkey
		$template->set_transmissionType(1);//透传消息类型
		$template->set_transmissionContent($msg);//透传内容


		//APN高级推送
		$apn = new IGtAPNPayload();
		$alertmsg=new DictionaryAlertMsg();
		$alertmsg->body="body";
		$alertmsg->actionLocKey="ActionLockey";
		$alertmsg->locKey="LocKey";
		$alertmsg->locArgs=array("locargs");
		$alertmsg->launchImage="launchimage";

		// IOS8.2
		$alertmsg->title="Title";
		$alertmsg->titleLocKey="TitleLocKey";
		$alertmsg->titleLocArgs=array("TitleLocArg");

		$apn->alertMsg=$alertmsg;
		$apn->badge=7;
		$apn->sound="";
		$apn->add_customMsg("payload","payload");
		$apn->contentAvailable=1;
		$apn->category="ACTIONABLE";
		$template->set_apnInfo($apn);

		return $template;
	}
}


























