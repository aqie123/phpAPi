<?php
/**
 * @name UserController
 * @author aqie
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class UserController extends Yaf_Controller_Abstract {

	public function indexAction(){
		return $this->loginAction();
	}
	
	public function loginAction(){
		// 阻止爬虫模拟登陆
		// submit 默认值为0，传任意值可通过
		
		// $submit = $this->getRequest()->getPost('submit', '0');
		$submit = Common_Request::postRequest('submit' , '0');
		if($submit!='1'){
		   //	echo Common_Request::response(-1001, '请通过正常渠道提交');
			echo json_encode(Err_Map::get(1001));
			return false;
		}
	   // echo '登陆成功';return false;
		
		
		// 获取参数
	   $uname = Common_Request::postRequest('uname', false);
	   $pwd = Common_Request::postRequest('pwd', false);
	   if(!$uname || !$pwd){
		   // echo Common_Request::response(-1002, '用户名或密码不能为空');
		   echo json_encode(Err_Map::get(1002));
		   return false;
	   }

	   // 调用model做简单验证
	   $model = new UserModel();
	   $uid = $model->login(trim($uname), trim($pwd));
	   if($uid){
			// session
		   session_start();
		   $_SESSION['user_token'] = md5('salt'.$_SERVER['REQUEST_TIME'].$uid);
		   $_SESSION['user_token_time'] = $_SERVER['REQUEST_TIME'];
		   $_SESSION['user_id'] = $uid;
		   echo Common_Request::response(0,'',array('name'=>$uname));
	   } else {
		   echo Common_Request::response(
			   $model->errno, 
			   $model->errmsg,
			   $uid
		   );		
	   }
		

	   return false;
	   
	}
	
	public function testAction(){
		echo "user/test";
		return false;
	}

	
   public function registerAction(){
	   $uname = $this->getRequest()->getPost('uname', false);
	   $pwd   = $this->getRequest()->getPost('pwd', false);
	   if(!$uname || !$pwd){
		   echo json_encode(Err_Map::get(1002));
		   return false;
	   }
	 
	   $userModel = new UserModel();

	   if($userModel->register(trim($uname), trim($pwd))){
		   echo Common_Request::response(0,'',array('name'=>$uname));
	   } else {
		   echo Common_Request::response($userModel->errno,$userModel->errmsg);
	   }
	   return false;

   }
}
