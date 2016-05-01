<?php

namespace library\Dao;
/**
 * DB 
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Simple.xull<simple.xull@gmail.com> 
 */
class DB {

	private static $_instance = null;

	private $link;

	private function __construct ()
	{
		$this->connect();
	}

	public static function getInstance ()
	{
		if ((self::$_instance instanceof self) === false) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	protected function connect ()
	{
// 		database.hostname = "127.0.0.1"
// database.port = 3306
// database.database = "zeo"
// database.username = "zeo"
// database.password = "zeo123456"
// database.charset = "UTF8"
// database.driver_options.1002 = "SET NAMES utf8"
		$dbConfig = \Yaf\Registry::get("config")->database;	
		$this->link = new \mysqli($dbConfig->hostname, $dbConfig->username, $dbConfig->password, $dbConfig->database, $dbConfig->port);
	}




	private function __clone () {}

}
