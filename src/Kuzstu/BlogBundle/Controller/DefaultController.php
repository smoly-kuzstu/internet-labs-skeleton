<?php

namespace Kuzstu\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Kuzstu\BlogBundle\Model as Model; 

use Kuzstu\BlogBundle\Model\Decorator as Decorator; 
class DefaultController extends Controller
{
    /**
     * @Route("/viewitem-decorator/{id}", name="kuzstu_blog_view_item_decorator")
     * @Method("GET")
     * @Template("KuzstuBlogBundle:Default:viewItemAction.html.twig")
    */
    public function viewItemWithDecoratorAction($id){
        $model = new Model\CrudOperationsModel(
            $this->getDoctrine()->getManager()
        );
        
        $modelDecorator = new Decorator\AclDecorator($model, null);
        $modelDecorator = new Decorator\CacheDecorator($modelDecorator, null);

        return array(
            'item' => $modelDecorator->readItem($id)
        );
    }
    
   /**
     * @Route("/", name="kuzstu_blog_index")
     * 
    */
    public function indexAction()
    {
        $model = new Model\CrudOperationsModel(
            $this->getDoctrine()->getManager()
        );
        
        $items = $model->readItemsList();
        
        $content = $this->renderView('KuzstuBlogBundle:Default:index.html.twig', 
           array(
               'items' => $items
            )
        );
        
        return new Response($content, 200);
    }
    
   /**
     * @Route("/viewitem/{id}", name="kuzstu_blog_view_item")
     * @Method("GET")
     * @Template("KuzstuBlogBundle:Default:viewItem.html.twig")
    */
    public function viewItemAction($id){
        $model = $this->container->get('kuzstu_blog.crud_model');
        return array(
            'item' => $model->readItem($id)
        );
    }
    
}
