<?php

namespace App\Controller\Main;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController {

    public function forRender(){

        return [
            "title" => "I'm BaseController, and i returned default value"
        ];
    }
}


