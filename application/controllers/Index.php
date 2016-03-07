<?php

/**
 * 首页Index
 */
class IndexController extends Yaf\Controller_Abstract {

    public function indexAction () 
    {
        $content = "Hello Yaf!";
        $this->getView()->assign('content', $content);
    }




}


