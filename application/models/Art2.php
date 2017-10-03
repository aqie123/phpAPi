<?php
/**
 * @name ArtModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 * @author aqie
 */
class ArtModel {
	public $errno = 0;
	public $errmsg = '';
	private $_db = null;
	
	public function __construct() {
		$this->_db = new PDO('mysql:host=127.0.0.1;dbname=test;', 'root', 'root');
		// 防止 pdo拼接sql把int 0转换成sting 0
		// $this->_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}  
    public function test($a,$b,$c,$d){
		return 233;
	}	
    

	// 添加文章方法
    	
	public function add($title, $contents, $author, $cate, $artId=0){
		$isEdit = false;
		// 编辑操作
		
		if($artId!=0 && is_numeric($artId)){
			$query = $this->_db->prepare('select count(*) from `art` where id = ?');
			$query->execute(array($artId));
			$ret = $query->fetchAll();
			if(!$ret || count($ret)!=1){
				$this->errno = -2004;
				$this->errmsg = '找不到所需要编辑文章';
				return false;
			}

			$isEdit = true;
		}else{
			// 新增文章
			// 检查cate是否存在
			$query = $this->_db->prepare('select count(*) from cate where id = ?');
			$query->execute(array($cate));
			$ret = $query->fetchAll();
			if(!$ret || $ret[0][0]==0){
				$this->errno = -2005;
				$this->errmsg = '找不到对应的文章分类';
				return false;
			}
		}
		// 插入或者更新文章内容
		$data = array($title, $contents, $author, intval($cate));
		if(!$isEdit){
			$query = $this->_db->prepare('insert into art (title, contents, author, cate) values(?, ?, ?, ?)');
		}else{
			$query = $this->_db->prepare('update art set title=?, contents=?, author=?, cate=? where id=?');
			$data[] = $artId;
		}
		$ret = $query->execute($data);
		if(!$ret){
			$this->errno = -2006;
			$this->errmsg = '操作文章数据表失败,ErrInfo:'.end($query->errorInfo());
			return false;
		}

		// 返回文章最后id
		if(!$isEdit){
			return intval($this->_db->lastInsertId());
		}else{
			return intval($artId);
		}

	}
}







