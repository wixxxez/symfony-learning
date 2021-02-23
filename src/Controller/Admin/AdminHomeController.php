<?php
namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminHomeController extends AdminBaseController
{

    /**
     * @Route("/admin", name="adminHomePage")
     * @return Response
     */
    public function index(){
        
        $data = parent::forRender();
        
        return $this->render('admin/index.html.twig',$data);
    }
}