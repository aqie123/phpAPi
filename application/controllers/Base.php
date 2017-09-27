<?php
/**
 * @name BaseController
 * @author aqie
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
	 */
class BaseController extends Yaf_Controller_Abstract {
	public function ajaxReturn(){
		header('Content-Type:application/json; charset=utf-8');
	    echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
}
