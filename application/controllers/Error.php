<?php

class ErrorController extends Yaf\Controller_Abstract {

    public function errorAction ($exception)
    {
        assert($exception === $exception->getCode());
        echo "Code:" . $exception->getCode() . " Message:" . $exception->getMessage();



    }

}
