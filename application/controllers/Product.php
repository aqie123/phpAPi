<?php
/**
 * @name ProductController
 * @author aqie
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
	 */
class ProductController extends Yaf_Controller_Abstract {
	public function choclolat(){
		echo "this is Choclolat";
		return false;
	}

	public function apple(){
		echo "this is apple";
		return false;
	}

	// view 方法
	public function viewAction(){
		$name = $this->getRequest()->getParam('ident');
		echo $name;
		return false;
	}
}
