<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog_list")
     */
    public function indexAction()
    {
        return $this->render('@Blog/Default/index.html.twig');
    }


    /**
     * @Route("/blog/{id}/{anne}/{titre}", name="blog_show", requirements={"id": "\d+", "annee": "\d{4}", "titre": "[a-zA-Z]+","ext": "html"})
     */
    public function showAction($id, $anne)
    {
        return new Response('page show id:' .$id . 'year'.$anne);
    }

}
