<?php

use Dao\DB AS DB;
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


    public function _initDB (Yaf\Dispatcher $dispatcher) 
    {
        // $config = Yaf\Registry::get('config');

        // new DB();
    }


    public function _initSpl (Yaf\Dispatcher $dispatcher) 
    {
        # 需要默认自动载入一些常用类，诸如：DB/Cache/Views/Log等
        
        # 如果还是找不到的话，则进入autoRegister 再次寻找！                
        spl_autoload_register('autoRegister');
    }


}



