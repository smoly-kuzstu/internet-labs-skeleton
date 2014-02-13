<?php

namespace Kuzstu\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Kuzstu\BlogBundle\Model as Model; 

class DefaultController extends Controller
{
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
        
        return new Response($content);
    }
    
   /**
     * @Route("/viewitem/{id}", name="kuzstu_blog_view_item")
     * @Method("GET")
     * @Template("KuzstuBlogBundle:Default:viewItemAction.html.twig")
    */
    public function viewItemAction($id){
        $model = $this->container->get('kuzstu_blog.crud_model');
        return array(
            'item' => $model->readItem($id)
        );
    }
    
}
