<?php

use library\Dao\DB;

class Abstracts
{
	
	public function __construct ()
	{
		$db = DB::getInstance();
	}
}