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
     * @var \Turnos
     *
     * @ORM\ManyToOne(targetEntity="Turnos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="turno_id", referencedColumnName="int_turno_id")
     * })
     */
    private $turno;



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
     * Set turno
     *
     * @param \AE\DataBundle\Entity\Turnos $turno
     * @return Ofrendas
     */
    public function setTurno(\AE\DataBundle\Entity\Turnos $turno = null)
    {
        $this->turno = $turno;
    
        return $this;
    }

    /**
     * Get turno
     *
     * @return \AE\DataBundle\Entity\Turnos 
     */
    public function getTurno()
    {
        return $this->turno;
    }
}