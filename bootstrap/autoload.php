<?php



function autoRegister ($class = '')
{
	$config = Yaf\Registry::get("config");

	$workspace = $config->application->directory;
	$model_path = $workspace . '/models/';
	Yaf\Loader::import($model_path . $class . ".php");

}