<?
namespace App\Controller\Admin;

use App\Entity\Publication;
use App\Entity\Category;
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
        $catList = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $data['title'] = "Admin Post Controller";
        $data['posts'] = $post;
        $data['catList'] = $catList;
        return $this->render('admin/publications/index.html.twig',$data);
    }
    /**
     * @Route("admin/publication/create",name="PublicationCreate")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request) {

        $post = new Publication();
        $catList = $this->getDoctrine()->getRepository(Category::class)->findAll();
        if(empty($catList)){
            $this->addFlash('success',"OMG !!! RETARD ALERT CLAIM !!!");
            return $this->redirectToRoute('Publication');
        }
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
     /**
     * @Route("admin/publication/update/{id}",name="PublicationUpdate")
     * @param int $id
     * @param Request $request
     */
    public function update(int $id, Request $request){

        $em=$this->getDoctrine()->getManager();
        $post = $this->getDoctrine()->getRepository(Publication::class)->find($id);

        $form= $this->createForm(PublicationType::class,$post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if($form->get('save')->isClicked()){
                $post->setUpdateAtValue();
                
                $this->addFlash('success', 'Publication has been updated');
            }
            if($form->get('delete')->isClicked()){
                $this->addFlash('success', 'Publication removed');
                $em->remove($post);
            }
            $em->flush();
            return $this->redirectToRoute('Publication');
        }

        $data=parent::forRender();
        $data['title']="AdminPostController functionUpdate greetings you";
        
        $data['form'] = $form->createView();
        return $this->render('admin/publications/create.html.twig',$data);
    }


}