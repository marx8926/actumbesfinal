<?php

namespace AE\GanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AE\DataBundle\Entity\Persona;
use AE\DataBundle\Entity\Ubicacion;
use AE\DataBundle\Entity\Ubigeos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AEGanaBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public  function busquedaAction()
    {
        
         $securityContext = $this->get('security.context');
        
        
        if($securityContext->isGranted('ROLE_LIDER_RED'))
        {
        $ganador = $securityContext->getToken()->getUser()->getIdPersona();
        $red = NULL;
        $em = $this->getDoctrine()->getManager();
        
        if($ganador != NULL)
        {
            $sql = "select * from get_red_persona(:id)";
            $smt = $em->getConnection()->prepare($sql);
            $smt->execute(array(':id'=>$ganador->getId()));
            $req = $smt->fetch();
            
            $red = $req['red'];
        }
        
        return $this->render('AEGanaBundle:Default:busqueda.html.twig',
                array('red'=>$red));
        }
        else return $this->render('AEGanaBundle:Default:sinacceso.html.twig');
        
        
    }
 
    
    public function viewAction($id)
    {
         $nombre = NULL;
        $apellidos = NULL;
        $estado_civil = NULL;
        $edad = NULL;
        $telefono = NULL;
        $celular = NULL;
        $fecha_nacimiento = NULL;
        $email = NULL;
        $website = NULL;
        $sexo = NULL;
        $id_ubicacion = NULL;
        $direccion = NULL;
        $referencia = NULL;
        $latitud = NULL;
        $longitud = NULL;
        $id_ubigeo = NULL;
        $departamento = NULL;
        $provincia = NULL;
        $distrito = NULL;
        $red = NULL;
        $celula = NULL;
        $lider_ap = NULL;
        $lider_nom = NULL;
        $cons_ap = NULL;
        $cons_nom = NULL;
        $conversion = NULL;
        $peticion = NULL;
        $dni = NULL;
        $ocupacion = NULL;
        
        $ubigeo = array();
        $redes = array();
        $convertido = array();
        
        $em = $this->getDoctrine()->getManager();

        
        try {
            $em->beginTransaction();
            
           
            $prev_div = $em->getRepository('AEDataBundle:Persona');
            $p = $prev_div->findOneBy(array('id'=>$id));
            
            //$p = new Persona();
            $nombre = $p->getNombre(); $apellidos = $p->getApellidos();
            $estado_civil = $p->getEstadoCivil(); $edad = $p->getEdad();
            $telefono = $p->getTelefono(); $celular = $p->getCelular();
            $data = $p->getFechaNacimiento();
            $fecha_nacimiento = $data->format('d-m-Y');
            $email = $p->getEmail(); $website = $p->getWebsite();
            $sexo = $p->getSexo(); 
            $id_ubicacion = $p->getIdUbicacion();
            $direccion = $p->getIdUbicacion()->getDireccion(); $referencia = $p->getIdUbicacion()->getReferencia();
            $ubigeo = $p->getIdUbicacion()->getUbigeo();
            $distrito = $ubigeo->getStringUbigeoDescripcion();
            
            $prev_ubi = $em->getRepository('AEDataBundle:Ubigeos');
            $prov = $prev_ubi->findOneBy(array('intUbigeoId'=>$ubigeo->getIntUbigeoDependencia()));
            $provincia = $prov->getStringUbigeoDescripcion();
            
            
            $dep = $prev_ubi->findOneBy(array('intUbigeoId'=>$prov->getIntUbigeoDependencia()));
            $departamento = $dep->getStringUbigeoDescripcion();
          
            $red = $p->getRed()->getId();
            
            $prev_nivel = $em->getRepository('AEDataBundle:NivelCrecimiento');
            $nivel = $prev_nivel->findOneBy(array('persona'=>$id));
            $conversion = $nivel->getCreacion()->format('d-m-Y');
            $peticion = $p->getPeticion();
            $em->commit();
            
        } catch (Exception $exc) {
            $em->rollback();
            $em->close();
            throw $exc;
        }

       
        return $this->render('AEGanaBundle:Default:vista.html.twig',array('id'=>$id,'nombre'=>$nombre,
            'apellidos'=>$apellidos,'estado_civil'=>$estado_civil,'edad'=>$edad, 'telefono'=>$telefono,'celular'=>$celular,
            'fecha_nacimiento'=>$fecha_nacimiento,'email'=>$email,'website'=>$website,'sexo'=>$sexo,'id_ubicacion'=>$id_ubicacion,
            'direccion'=>$direccion,'referencia'=>$referencia,'latitud'=>$latitud,'longitud'=>$longitud,'id_ubigeo'=>$id_ubigeo,
            'departamento'=>$departamento,'provincia'=>$provincia,'distrito'=>$distrito,
            'red'=>$red,'celula'=>$celula,'lider'=>$lider_ap.' '.$lider_nom,'cons'=>$cons_ap.' '.$cons_nom,
            'conversion'=>$conversion,'peticion'=>$peticion,
            'dni'=>$dni, 'ocupacion'=>$ocupacion));
    }
}
