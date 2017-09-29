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
}
