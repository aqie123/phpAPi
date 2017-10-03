<?php

// 微信支付模型

class Wxpay2Model{
	public $errno = 0;
	public $errmsg = '';
	private $_db;

	public function __construct(){
		$this->_db = new PDO('mysql:host=127.0.0.1;dbname=test;','root','root');
	}

	public function createbill($itemId, $uid){
		// 验证商品是否存在,是否过期,库存是否充足(商品表 item id关联 bill表 itemid)i
		/*
		$query = $this->_db->prepare('select * from	`item` where id = ?');
		$query->execute(array($itemId));
		$ret = $query->fetch(PDO::FETCH_ASSOC);
		if(!$ret){
			$this->errno = -6003;
			$this->errmsg = '找不到该商品';
			return false;
		}*/
		return 233;
		/*
		if(strtotime($ret['etime']) <= time()){
			$this->errno = -6004;
			$this->errmsg = '商品过期，不能购买';
			return false;
		}

		if(intval($ret['stock']) <= 0){
			$this->errno = -6005;
			$this->errmsg = '商品库存不足,无法购买';
			return false;
		}

		// 创建订单bill
		$query = $this->_db->prepare('insert into bill(itemid,uid,price,status) values(?,?,?,“unpaid”)');
		$res = $query->execute(array($itemId,$uid,$ret['price']));
		if(!$res){
			$this->errno = -6006;
			$this->errmsg = '创建订单失败';
			return false;
		}
		
		$lastId = intval($this->_db->lastInsertId());

		// 减库存
		$query = $this->_db->prepare('update item set stock=stock-1 where id = ?');
		$ret = $query->execute(array($itemId));
		if(!$ret){
			$this->errno = -6006;
			$this->errmsg = '更新库存失败';
			return false;
		}

		return $lastId;
		 */
	}
}
