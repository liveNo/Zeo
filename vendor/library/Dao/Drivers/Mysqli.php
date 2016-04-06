<?php

class Mysqli {

	static $_instance = null;

	private $_dbLink = null;

	private $_defaultConfig = array(
		'master' => array(),
		'slave' => array()
	);

	private $_dbMode = "common"; // common/master-salve/distributed  | / 单机/主从/分布式

    private function __construct ( $dbConfig = array() ) {
    	$this->connect($dbConfig);
    }


    public static function getInstance( $dbConfig = array() ) 
    {
    	if ( !(self::$_instance instanceof self) ) {
    		self::$_instance = new self($dbConfig);
    	}
    	return self::$_instance;
    }

    private function connect ( $dbConfig = array() )
    {

    }



}
