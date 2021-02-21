<?php

namespace App\Controller\Main;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController {

    /**
     * @Route("/", name="homePage")
     */
    public function index(){

        $data = parent::forRender();
        return $this->render('main/index.html.twig',$data);

    }
}