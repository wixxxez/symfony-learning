<?
namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminCategoryController extends AdminBaseController {
    /**
     * @Route("admin/category/",name="Category")
   
     */
    public function index(){

        $category = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $data = parent::forRender();

        $data['title'] = "Admin Category Controller";
        $data['category'] = $category;

        return $this->render('admin/category/index.html.twig',$data);
    }
    /**
     * @Route("admin/category/create",name="CategoryCreate")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request) {

        $category = new Category();

        $form = $this->createForm(CategoryType::class,$category);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $category->setCreatedAtValue();
            
            $category->setIsPublished(true);
            $em->persist($category);
            $em->flush();
            $this->addFlash('success',"Category added! ");
            return $this->redirectToRoute('Category');
        }
        
        
        $data=parent::forRender();
        $data['title']="AdminCategoryController greetings you";
        
        $data['form'] = $form->createView();
        return $this->render('admin/category/create.html.twig',$data);
    }
}