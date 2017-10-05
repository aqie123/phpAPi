<?php

// 公共请求库抽离

class Common_Request{

	/**
	 *  Yaf_Controller_Abstract
	 *  Yaf_Request_Simple extends Yaf_Request_Abstract
	 *  Yaf_Controller_Abstract里面方法 public Yaf_Request_Abstract getRequest()
	 *  返回值 Yaf_Request_Abstract instance
	 */

	static public function request($key, $default=null, $type = null){
		if($type == 'get'){	
	    	$result = isset($_GET[$key]) ? trim($_GET[$key]) : null;
		}elseif($type == 'post'){	
		    $result = isset($_POST[$key]) ? trim($_POST[$key]) : null;
		}else{	
		    $result = isset($_REQUEST[$key]) ? trim($_REQUEST[$key]) : null;
		}		
		if($result == null && $default != null ){
			$result = $default;
		}
		return $result;
	}	
	static public function getRequest($key, $default=null){
		return self::request($key, $default, 'get');
	}

	static public function postRequest($key, $default = null){			
		return self::request($key, $default, 'post');
	}

	static public function response($errno=0, $errmsg = '', $data = array()){
		$rep = array(
			'errno' => $errno,
			'errmsg' => $errmsg,
		);
		if(!empty($data)){
			$rep['data'] = $data;
		}
		return json_encode($rep);
	}

}
