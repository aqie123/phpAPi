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
		
		$submit = $this->getRequest()->getQuery('submit', '0');
		if($submit!='1'){
			echo json_encode(array(
				'errno'=>-1001,
				'errmsg'=>'请通过正确渠道登录'
			));
			return false;
		}
	   // echo '登陆成功';return false;
		
		
		// 获取参数
	   $uname = $this->getRequest()->getPost('uname', false);
	   $pwd   = $this->getRequest()->getPost('pwd', false);
	   if(!$uname || !$pwd){
		   echo json_encode(array('errno'=>-1002, 'errmsg'=>'用户名和密码必填'));
		   return false;
	   }

	   // 调用model做简单验证
	   $userModel = new UserModel();
	   $uid = $userModel->login(trim($uname), trim($pwd));
	   if($uid){
			// session
		   session_start();
		   $_SESSION['user_token'] = md5('salt'.$_SERVER['REQUEST_TIME'].$uid);
		   $_SESSION['user_token_time'] = $_SERVER['REQUEST_TIME'];
		   $_SESSION['user_id'] = $uid;
		   echo json_encode(array(
				'errno'=>0,
				'errmsg'=>'',
				'data'=>array('data'=>$uname)
		   ));
	   } else {
		   echo json_encode(array(
				'errno'=>$userModel->errno,
				'errmsg'=>$userModel->errmsg
		   ));
			
	   }
		

	   return true;
	   
	}
	
	public function testAction(){
		echo "user/test";
		return false;
	}

	
   public function registerAction(){
	   //  echo 'zhuce';
	   $uname = $this->getRequest()->getPost('uname', false);
	   $pwd   = $this->getRequest()->getPost('pwd', false);
	   if(!$uname || !$pwd){
		   echo json_encode(array('error'=>-1002, 'errmsg'=>'用户名和密码必填'));
		   return false;
	   }
	 
	   $userModel = new UserModel();

	   if($userModel->register(trim($uname), trim($pwd))){
			echo json_encode(array(
				'error'=>0,
				'errmsg'=>'',
				'data'=>array('name'=>$uname)
			));
	   } else {
			echo json_encode(array(
				'error'=>$userModel->errno,
				'errmsg'=>$userModel->errmsg
			));
	   }
	   return false;

   }
}
