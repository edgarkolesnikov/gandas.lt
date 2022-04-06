<?php

namespace Controller;

use Core\ControllerAbstract;
use Model\Collection\News;
use Service\GetNewsFromApi\WebitNews;

class Api extends ControllerAbstract{

    public function getall()
    {

        $obj = new WebitNews();
        $obj->exec();

    }
}