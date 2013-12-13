<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ofrendas
 *
 * @ORM\Table(name="ofrendas")
 * @ORM\Entity
 */
class Ofrendas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_ofrenda_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ofrendas_int_ofrenda_id_seq", allocationSize=1, initialValue=1)
     */
    private $intOfrendaId;

    /**
     * @var float
     *
     * @ORM\Column(name="dec_ofrenda_monto", type="decimal", nullable=true)
     */
    private $decOfrendaMonto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dec_ofrenda_fecharegistro", type="datetime", nullable=true)
     */
    private $decOfrendaFecharegistro;

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
     * Get intOfrendaId
     *
     * @return integer 
     */
    public function getIntOfrendaId()
    {
        return $this->intOfrendaId;
    }

    /**
     * Set decOfrendaMonto
     *
     * @param float $decOfrendaMonto
     * @return Ofrendas
     */
    public function setDecOfrendaMonto($decOfrendaMonto)
    {
        $this->decOfrendaMonto = $decOfrendaMonto;
    
        return $this;
    }

    /**
     * Get decOfrendaMonto
     *
     * @return float 
     */
    public function getDecOfrendaMonto()
    {
        return $this->decOfrendaMonto;
    }

    /**
     * Set decOfrendaFecharegistro
     *
     * @param \DateTime $decOfrendaFecharegistro
     * @return Ofrendas
     */
    public function setDecOfrendaFecharegistro($decOfrendaFecharegistro)
    {
        $this->decOfrendaFecharegistro = $decOfrendaFecharegistro;
    
        return $this;
    }

    /**
     * Get decOfrendaFecharegistro
     *
     * @return \DateTime 
     */
    public function getDecOfrendaFecharegistro()
    {
        return $this->decOfrendaFecharegistro;
    }

    /**
     * Set servicio
     *
     * @param \AE\DataBundle\Entity\Servicios $servicio
     * @return Ofrendas
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
}