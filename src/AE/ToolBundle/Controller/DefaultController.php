<?php

namespace AE\ToolBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ps\PdfBundle\Annotation\Pdf;
class DefaultController extends Controller
{
    /**
    * @Pdf()
    */
    public function indexAction($name)
    {
       // return $this->render('AEToolBundle:Default:index.html.twig', array('name' => $name));
        $format = $this->get('request')->get('_format');

        return $this->render(sprintf('AEToolBundle:Default:index.%s.twig', $format), array(
            'name' => $name,
            ));
        
        
    }
}
