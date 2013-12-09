<?php

namespace AE\DataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AEDataBundle:Default:index.html.twig', array('name' => $name));
    }
}
