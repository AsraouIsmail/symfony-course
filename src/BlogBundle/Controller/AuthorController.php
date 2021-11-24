<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /**
     * @Route("/author/create")
     */
    public function createAction()
    {
        $author = new Author();

        $author->setFirstname("Mouhja");
        $author->setLastname("Bencharki");

        $em = $this->getDoctrine()->getManager();

        $em->persist($author);
        $em->flush();

        return new Response("Author created");
    }


     /**
     * @Route("/author")
     */
    public function indexAction()
    {
        return $this->render('BlogBundle:Author:create.html.twig', array(
            // ...
        ));
    }

}
