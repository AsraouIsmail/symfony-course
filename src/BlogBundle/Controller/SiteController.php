<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SiteController extends Controller
{
    /**
     * @Route("/acceuil", name="site_acceuil")
     */
    public function acceuilAction()
    {
        return $this->render('@Blog/site/acceuil.html.twig');
    }

    /**
     * @Route("/service", name="site_service")
     */
    public function serviceAction()
    {
        return $this->render('@Blog/site/service.html.twig');
    }

    /**
     * @Route("/contact", name="site_contact")
     */
    public function contactAction()
    {
        return $this->render('@Blog/site/contact.html.twig');
    }

}
