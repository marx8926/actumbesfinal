<?php

namespace AE\DiscipulaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AEDiscipulaBundle:Default:index.html.twig', array('name' => $name));
    }
}
