<?php
/**
 * @name ArtController
 * @author aqie
 * @desc 文章控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
	 */
class ArtController extends Yaf_Controller_Abstract {

	public function indexAction(){
		return $this->listAction();
	}
	public function testAction(){
		echo 'art/test';
		$model = new ArtModel();
		$lastid = $model->aqie();
	     echo $lastid;	
		return false;
	}
	
	
	public function addAction($artId=0){
		// 是否是管理员
		if(!$this->_isAdmin()){
			echo json_encode(array('errno'=>-2000, 'errmsg'=>'需要管理员才能操作'));
			return false;
		}
		// 是否是正常途径登录
		$submit = $this->getRequest()->getQuery('submit', '0');
		if($submit != '1'){
			echo json_encode(array(
				'errno'=>-1001,
				'errmsg'=>'请通过正确渠道登录'
			));
			return false;
		}

		// 获取文章提交参数
		$title = $this->getRequest()->getPost('title',false);
		$contents = $this->getRequest()->getPost('contents', false);
		$author = $this->getRequest()->getPost('author', false);
		$cate = $this->getRequest()->getPost('cate', false);

		// 对参数进行检查
		if(!$title || !$contents || !$author || !$cate ){
			echo json_encode(array(
				'errno'=>-1002,
				'errmsg'=>'标题，内容，作者，分类不能为空'
			));
			return false;
		}
		
		// 调用模型，做文章内容添加
/*		$ArtModel = new ArtModel();
		
		if($lastId = $ArtModel->add(trim($title), trim($contents), trim($author), trim($cate), $artId)){
			echo json_encode(array(
				'errno'=>0,
				'errmsg'=>''，
				'data'=>array('lastId'=>$lastId)
			));	
			
		}else{
			echo  json_encode(array(
				'errno'=>$ArtModel->errno,
				'errmsg'=>$ArtModel->errmsg
			));
		}
*/
		return true;
	}
    
	 
	
	public function editAction(){
		// 编辑功能复用添加功能
		// $this->addAction($artId);

		// 是否是管理员
		if(!$this->_isAdmin()){
			echo json_encode(array('errno'=>-2000, 'errmsg'=>'需要管理员才能操作'));
			return false;
		}

		$artId = $this->getRequest()->getQuery('artId', 0);
		if(is_numeric($artId) && $artId){
			return $this->addAction($artId);
		}else{
			echo json_encode(array(
				'errno'=>-2003,
				'errmsg'=>'缺少必要的文章参数ID'
			));
		}
		
		return true;
	}
	 

	public function delAction(){
		return true;
	}

	public function statusAction(){
		
	}

	public function getAction(){
		
	}

	public function listAction(){
		
	
	}

	private function _isAdmin(){

		return true;
	}

}
