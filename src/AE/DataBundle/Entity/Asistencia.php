<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencia")
 * @ORM\Entity
 */
class Asistencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_asistencia_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="asistencia_int_asistencia_id_seq", allocationSize=1, initialValue=1)
     */
    private $intAsistenciaId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_asistencia_fecregistro", type="datetime", nullable=true)
     */
    private $datAsistenciaFecregistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_asistencia_fecasistencia", type="datetime", nullable=true)
     */
    private $datAsistenciaFecasistencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_asistencia_cantidad", type="integer", nullable=true)
     */
    private $intAsistenciaCantidad;

    /**
     * @var \Servicios
     *
     * @ORM\ManyToOne(targetEntity="Servicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="servicio_id", referencedColumnName="int_servicio_id")
     * })
     */
    private $servicio;

    /**
     * @var \Red
     *
     * @ORM\ManyToOne(targetEntity="Red")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="red_id", referencedColumnName="int_red_id")
     * })
     */
    private $red;



    /**
     * Get intAsistenciaId
     *
     * @return integer 
     */
    public function getIntAsistenciaId()
    {
        return $this->intAsistenciaId;
    }

    /**
     * Set datAsistenciaFecregistro
     *
     * @param \DateTime $datAsistenciaFecregistro
     * @return Asistencia
     */
    public function setDatAsistenciaFecregistro($datAsistenciaFecregistro)
    {
        $this->datAsistenciaFecregistro = $datAsistenciaFecregistro;
    
        return $this;
    }

    /**
     * Get datAsistenciaFecregistro
     *
     * @return \DateTime 
     */
    public function getDatAsistenciaFecregistro()
    {
        return $this->datAsistenciaFecregistro;
    }

    /**
     * Set datAsistenciaFecasistencia
     *
     * @param \DateTime $datAsistenciaFecasistencia
     * @return Asistencia
     */
    public function setDatAsistenciaFecasistencia($datAsistenciaFecasistencia)
    {
        $this->datAsistenciaFecasistencia = $datAsistenciaFecasistencia;
    
        return $this;
    }

    /**
     * Get datAsistenciaFecasistencia
     *
     * @return \DateTime 
     */
    public function getDatAsistenciaFecasistencia()
    {
        return $this->datAsistenciaFecasistencia;
    }

    /**
     * Set intAsistenciaCantidad
     *
     * @param integer $intAsistenciaCantidad
     * @return Asistencia
     */
    public function setIntAsistenciaCantidad($intAsistenciaCantidad)
    {
        $this->intAsistenciaCantidad = $intAsistenciaCantidad;
    
        return $this;
    }

    /**
     * Get intAsistenciaCantidad
     *
     * @return integer 
     */
    public function getIntAsistenciaCantidad()
    {
        return $this->intAsistenciaCantidad;
    }

    /**
     * Set servicio
     *
     * @param \AE\DataBundle\Entity\Servicios $servicio
     * @return Asistencia
     */
    public function setServicio(\AE\DataBundle\Entity\Servicios $servicio = null)
    {
        $this->servicio = $servicio;
    
        return $this;
    }

    /**
     * Get servicio
     *
     * @return \AE\DataBundle\Entity\Servicios 
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set red
     *
     * @param \AE\DataBundle\Entity\Red $red
     * @return Asistencia
     */
    public function setRed(\AE\DataBundle\Entity\Red $red = null)
    {
        $this->red = $red;
    
        return $this;
    }

    /**
     * Get red
     *
     * @return \AE\DataBundle\Entity\Red 
     */
    public function getRed()
    {
        return $this->red;
    }
}