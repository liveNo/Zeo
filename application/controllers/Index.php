<?php


// use application\models\User;
/**
 * IndexController 
 * 
 * @uses Yaf
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author 徐路路 <xululu@eventmosh.com> 
 * @license 北京活动时文化传媒有限公司
 */

class IndexController extends Yaf\Controller_Abstract {

    public function indexAction () 
    {
        // echo 111;die;
        new Auth();
        $content = "Hello Yaf!";
        $this->getView()->assign('content', $content);
    }



    public function testAction() 
    {

    }

    
    public function detailAction ()
    {
        // $this->getView()->assign();  
    }

}


