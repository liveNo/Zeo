<?php

class Bootstrap extends Yaf\Bootstrap_Abstract {

    public function _initConfig () 
    {
        $config = Yaf\Application::app()->getConfig();
        Yaf\Registry::set("config", $config);
    }




}



