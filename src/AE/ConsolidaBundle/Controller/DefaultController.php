<?php

namespace AE\ConsolidaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AEConsolidaBundle:Default:index.html.twig', array('name' => $name));
    }
}
