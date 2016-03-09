<?php

define("APP_PATH", realpath(dirname(__FILE__) . '/../'));

$app = new Yaf\Application(APP_PATH . "/config/application.ini");

// Todo: 分发请求

$app->bootstrap()->run();


