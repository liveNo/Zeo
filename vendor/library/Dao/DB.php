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
		$dbConfig = \Yaf\Registry::get("config")->database;	
		$this->link = new \mysqli($dbConfig->hostname, $dbConfig->username, $dbConfig->password, $dbConfig->database, $dbConfig->port);	
		
		/*
		 * This is the "official" OO way to do it,
		 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
		 */
		if ($this->link->connect_error) {
		    die('Connect Error (' . $this->link->connect_errno . ') ' . $this->link->connect_error);
		}

		// if ($result = $this->link->query("SELECT DATABASE()")) {
		//     $row = $result->fetch_row();
		//     printf("Default database is %s.\n", $row[0]);
		// }

		$this->link->select_db($dbConfig->database);
	}


	protected function query ($sql, $attr = '')
	{

	}


	protected function fetchOne ($sql, $attr = '')
	{
		$result = $this->link->query($sql);
		return $result;
	}



	private function __clone () {}

}
