<?php

namespace AE\ToolBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ps\PdfBundle\Annotation\Pdf;
use AE\DataBundle\Entity\Persona;
use AE\DataBundle\Entity\Ubicacion;
use AE\DataBundle\Entity\Ubigeos;
use AE\DataBundle\Entity\NivelCrecimiento;
use AE\DataBundle\Entity\DetalleMiembro;
use Symfony\Component\HttpFoundation\JsonResponse;


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
    
    public function cargar_dataAction($nombre)
    {
        getcwd();
        
        chdir('csv');
        
        set_time_limit ( 600 );
        
        $path = getcwd()."/".$nombre;
        
        $handle = fopen($path, "r");
        
        $todo = array();
        
        $em = $this->getDoctrine()->getManager();
        
        
        $primera = fgetcsv($handle, 0, ",");
        
        $em->beginTransaction();
        
        $prev_div = $em->getRepository('AEDataBundle:Ubigeos');
        $ubigeo = $prev_div->find(2031);
        
        
        
        $redes = $em->getRepository('AEDataBundle:Red');
        
        $lugares = $em->getRepository('AEDataBundle:Lugar');
        $lugar = $lugares->find(1);
        
        $cont =0;
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            $red = $redes->findOneBy(array('id'=>$data[3]));
            $todo[] = $data;        
            $cont++;
            //registro de ubicacion 
            
            $ubiq = new Ubicacion();
            $ubiq->setDireccion($data[5]);
            $ubiq->setReferencia($data[5]);
            $ubiq->setLatitud(-8.097944);
            $ubiq->setLongitud(-79.03704479999999);
            $ubiq->setUbigeo($ubigeo);
            
            $em->persist($ubiq);
            $em->flush();
            
            
            $persona = new Persona();
            
            
            if(strlen($data[0])>5)
                $persona->setDni($data[0]);
            else  $persona->setDni("12345678");
           
            $persona->setNombre($data[1]);
            $persona->setApellidos($data[2]);
            $persona->setLugar($lugar);
            
            //sexo
            if($data[3]=='M')
                $persona->setSexo(1);
            else $persona->setSexo(2);
            
            $persona->setCelular($data[6]);
            $persona->setOcupacion($data[7]);
            
            $est=0;
            if(strcmp($data[8],'S')==0)
                    $est=0;
                    
            if(strcmp($data[8],'C')==0)
                    $est=1;
            if(strcmp($data[8],'S')==0)
                    $est=0;
            if(strcmp($data[8],'CN')==0)
                    $est=2;
            
            if(strcmp($data[8],'VD')==0)
                    $est=3;
            
            if(strcmp($data[8],'SP')==0)
                    $est=4; 
            
            if(strcmp($data[8],'MS')==0)
                    $est=5;
            
            $persona->setEstadoCivil($est);
            
            $nac = NULL;
            //fecha nacimiento
            if(substr_count(strval($data[9]),'/')==2)
            {
                $fecha_a =explode('/', $data[9],3);
                
                if(intval($fecha_a[0])<13)
                    $fecha = $fecha_a[2].'-'.$fecha_a[0].'-'.$fecha_a[1];
                else
                    $fecha = $fecha_a[2].'-'.$fecha_a[1].'-'.$fecha_a[0];

                                 $nac = new \DateTime($fecha);
            }
            else
            {
                $nac = new \DateTime('1980-01-01');
            }
            
            $persona->setFechaNacimiento($nac);
            
            
            //edad
            
            $datetime1 = new \DateTime();
            $interval = $datetime1->diff($nac);
            
            $persona->setEdad(intval($interval->format('%y')));
            $persona->setIdUbicacion($ubiq);
            $persona->setAsisteCelula(TRUE);
            $persona->setActivo(TRUE);
            $persona->setDia("LUNES");
            $persona->setHora("12:00");
            $persona->setRed($red);
            
            $em->persist($persona);
            $em->flush();
            
              //guardar detalle miembro
                
            $det = new DetalleMiembro();
                
            
               $conv = NULL;
            //fecha nacimiento
            if(substr_count(strval($data[10]),'/')==2)
            {
               
                $fecha_a =explode('/', $data[10],3);
                
                if(intval($fecha_a[0])<13)
                    $fecha = $fecha_a[2].'-'.$fecha_a[0].'-'.$fecha_a[1];
                else
                    $fecha = $fecha_a[2].'-'.$fecha_a[1].'-'.$fecha_a[0];

                 
                $conv = new \DateTime($fecha);
            }
            else
            {
                $conv = new \DateTime('2000-01-01');
            }
            
            //registro nuevo convertido
          
             $nivel = new NivelCrecimiento();
                
                $nivel->setIntNivelcrecimientoEscala(0);
                $nivel->setIntNivelcrecimientoEstadoactual(1);
                $nivel->setRed($red);
                $nivel->setPersona($persona);
                $nivel->setCreacion($conv);
                
                
                $em->persist($nivel);
                $em->flush();
                
                
                $det->setActivo(TRUE);
                $det->setRed($red);
                $det->setPersona($persona);
                $det->setConvertido($conv);
                
                
                $em->persist($det);
                $em->flush();
            
          }
          
        $em->commit();
        $em->clear();
        $em->close();
        
        fclose($handle);
        
        return new JsonResponse($cont);
    }
}
