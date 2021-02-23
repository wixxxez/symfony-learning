<?php 
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBaseController extends AbstractController{

    public function forRender(){
        return [
            "title" => "Hey I'm Admin Base Conroller, and you see me when u login "
        ];
    }
}