<?php



function autoRegister ($class = '')
{

	// echo $class;die;
	$config = Yaf\Registry::get("config");
	// echo 111;die;
	$workspace = $config->application->directory;
	$model_path = $workspace . '/models/';
	// echo $model_path . $class;die;
	// Yaf\Loader::autoload($model_path . $class . ".php");
	Yaf\Loader::import($model_path . $class . ".php");

}