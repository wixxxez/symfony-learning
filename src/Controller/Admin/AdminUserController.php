<?php 
namespace App\Controller\Admin;

use App\Form\UserSiginFormType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\COmponent\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends AdminBaseController {

    /**
     * @Route("/admin/user", name="adminUserList")
     * @return Response
     */
    public function index(){
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();
        $data = parent::forRender();
        $data['users'] = $user;
        $data['title'] = "Welcome to the user page, I'm AdminUserController";
        return $this->render('admin/user/index.html.twig',$data);
    }

    /**
     * @Route ("/admin/reg",name="register")
     * @param Request $response
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function create(Request $response, UserPasswordEncoderInterface $passwordEncoder){

        $data = parent::forRender();
        $data['title'] = 'Registration form';
        $user = new User();
        $form = $this->createForm(UserSiginFormType::class, $user);
        $em = $this->getDoctrine()->getManager();
        $form -> handleRequest($response);

        if(($form->isSubmitted())&&($form->isValid())){
            $password = $passwordEncoder -> encodePassword($user, $user->getPlainPassword());
            $user -> setPassword($password);
            $user-> setRoles(['ROLE_ADMIN']);

            $em -> persist($user);
            $em->flush();
            return $this->redirectToRoute('adminUserList');
        }
        $data['form'] = $form->createView();
        return $this->render('admin/user/registration.html.twig',$data);
    }
}