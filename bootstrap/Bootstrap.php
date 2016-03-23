<?php

/**
 * Bootstrap 
 * 
 * @uses Yaf
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
class Bootstrap extends Yaf\Bootstrap_Abstract {

    public function _initConfig () 
    {
        $config = Yaf\Application::app()->getConfig();
        Yaf\Registry::set("config", $config);
    }

    
    public function _initDefaultName (Yaf\Dispatcher $dispatcher)
    {
        $dispatcher->setDefaultModule("Index")->setDefaultController("Index")->setDefaultAction("index"); 
    }

    public function _initLayout(Yaf\Dispatcher $dispatcher)
    {
    
    }

    public function _initRoute (Yaf\Dispatcher $dispatcher)
    {
        $route = Yaf\Dispatcher::getInstance()->getRouter();
        // 添加配置中的路由
        # $route->addConfig(Yaf\Registry::get('config')->routes);
    }

    public function _initPlugin (Yaf\Dispatcher $dispatcher)
    {
    
    }


}



