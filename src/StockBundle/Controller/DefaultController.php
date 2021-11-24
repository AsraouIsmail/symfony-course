<?php

namespace StockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Stock/Default/index.html.twig');
    }

    public function showAction($id, $annee)
    {
        return new Response('Show Action method has been executed'. $id . 'annee' .$annee);
    }
}
