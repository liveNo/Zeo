<?php

use library\Dao\DB;

class Abstracts
{
	protected $db;
	
	public function __construct ()
	{
		$this->db = DB::getInstance();
	}
}