<?php
/**
 * @name ArtModel
 * @desc base数据获取类, 可以访问数据库，文件，其它系统等
 * @author aqie
 */
class ArtModel {
	public $errno = 0;
	public $errmsg = '';
	private $_db = null;

	public function __construct() {
		$this->_db = new PDO('mysql:host=127.0.0.1;dbname=test;', 'root', 'root');
    }   
    
   public function aqie(){
		return 666;
   }
			
		
  public function add($title,$contents,$author,$cate,$artId=0){
	  $isEdit = false;
	  // 编辑操作
	  if($artId != 0 && is_numeric($artId)){
			$query = $this->_db->prepare('select * from art where id =?');
			$query->execute(array($artId));
			$ret = $query->fetchAll();
			if(!$ret || count($ret) != 1){
				$this->errno = -2004;
				$this->errmsg = '找不到所需要编辑的文章';
				return false;
			}

	        $isEdit = true;
	  } else {
			// 检查cate是否存在
		  $query = $this->_db->prepare('select count(*) from cate where id =?');
		  $query->execute(array($cate));
		  $ret = $query->fetchAll();
		  if(!$ret || $ret[0][0] == 0){
				$this->errno = -2005;
				$this->errmsg = '找不到对应文章分类';
				return false;
		  }
	  }
	  
	  // 插入或者更新文章内容
	  
	  $data = array($title, $contents, $author, intval($cate));
	  if(!$isEdit){
			$query = $this->_db->prepare("insert into art(title,contents,author,cate) values(?,?,?,?)");
	  }else{
			$query = $this->_db->prepare("update art set title=?,contents=?,author=?,cate=? where id=?");
			$data[] = $artId;
	  }
	  // 打印sql预处理语句
	  //$query->debugDumpParams(); 
	  $ret = $query->execute($data);
	 
	  
	  if(!$ret){
			$this->errno=-2006;
			$this->errmsg='操作文章数据失败';
			return false;
	  }else{
			$this->errno=0;
			$this->errmsg='插入数据成功';
	  }
	 // return json_encode($data); 	     
	  // 返回文章最后id

	  if(!$isEdit){
			return intval($this->_db->lastInsertId());
			//return 3;
	  }else{
			return intval($artId);
	  }
	   
  }// add函数结尾
	
  // 删除文章 
	public function del($artId){
	  // 判断文章id是否存在
	  if($artId != 0 && is_numeric($artId)){
		  $query = $this->_db->prepare('select * from art where id =?');
		   // $query->debugDumpParams();
			$query->execute(array($artId));
			$ret = $query->fetchAll();
			if(!$ret || count($ret) != 1){
				$this->errno = -2004;
				$this->errmsg = '找不到所需要编辑的文章';
				return false;
			}

	  }

	  $data = array($artId);
	  $query = $this->_db->prepare('delete from art where id=?');
	  $ret = $query->execute($data);
	  
	  if(!$ret){
			$this->errno=-2006;
			$this->errmsg='删除文章数据失败';
			return false;
	  }else{
			$this->errno=0;
			$this->errmsg='删除成功';
			return true;
	  }
	  
  }	

  // 修改文章状态
  public function status($artId,$status='offline'){
	$data = array( $status, $artId);
	$query = $this->_db->prepare('update art set status = ? where id=?');	
	$ret = $query->execute($data);
	  if(!$ret){
			$this->errno=-2006;
			$this->errmsg='编辑文章状态失败';
			return false;
	  }else{
			$this->errno=0;
			$this->errmsg='编辑文章状态成功';
			return true;
	  }

  }
}










