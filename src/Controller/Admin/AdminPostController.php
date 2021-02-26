<?
namespace App\Controller\Admin;

use App\Entity\Publication;
use App\Form\PublicationType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminPostController extends AdminBaseController {
    /**
     * @Route("admin/publication/",name="Publication")
   
     */
    public function index(){

        $post = $this->getDoctrine()->getRepository(Publication::class)->findAll();
        $data = parent::forRender();

        $data['title'] = "Admin Post Controller";
        $data['posts'] = $post;

        return $this->render('admin/publications/index.html.twig',$data);
    }
    /**
     * @Route("admin/publication/create",name="PublicationCreate")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request) {

        $post = new Publication();

        $form = $this->createForm(PublicationType::class,$post);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post->setCreatedAtValue();
            $post->setUpdateAtValue();
            $post->setIsPublished(true);
            $em->persist($post);
            $em->flush();
            $this->addFlash('success',"Publication added! ");
            return $this->redirectToRoute('Publication');
        }
        
        
        $data=parent::forRender();
        $data['title']="AdminPostController greetings you";
        
        $data['form'] = $form->createView();
        return $this->render('admin/publications/create.html.twig',$data);
    }
}