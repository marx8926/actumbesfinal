<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diezmos
 *
 * @ORM\Table(name="diezmos")
 * @ORM\Entity
 */
class Diezmos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_diezmo_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="diezmos_int_diezmo_id_seq", allocationSize=1, initialValue=1)
     */
    private $intDiezmoId;

    /**
     * @var float
     *
     * @ORM\Column(name="dec_diezmo_monto", type="decimal", nullable=true)
     */
    private $decDiezmoMonto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_diezmo_fecharegistro", type="datetime", nullable=true)
     */
    private $datDiezmoFecharegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="var_diezmo_peticion", type="string", length=200, nullable=true)
     */
    private $varDiezmoPeticion;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * })
     */
    private $persona;



    /**
     * Get intDiezmoId
     *
     * @return integer 
     */
    public function getIntDiezmoId()
    {
        return $this->intDiezmoId;
    }

    /**
     * Set decDiezmoMonto
     *
     * @param float $decDiezmoMonto
     * @return Diezmos
     */
    public function setDecDiezmoMonto($decDiezmoMonto)
    {
        $this->decDiezmoMonto = $decDiezmoMonto;
    
        return $this;
    }

    /**
     * Get decDiezmoMonto
     *
     * @return float 
     */
    public function getDecDiezmoMonto()
    {
        return $this->decDiezmoMonto;
    }

    /**
     * Set datDiezmoFecharegistro
     *
     * @param \DateTime $datDiezmoFecharegistro
     * @return Diezmos
     */
    public function setDatDiezmoFecharegistro($datDiezmoFecharegistro)
    {
        $this->datDiezmoFecharegistro = $datDiezmoFecharegistro;
    
        return $this;
    }

    /**
     * Get datDiezmoFecharegistro
     *
     * @return \DateTime 
     */
    public function getDatDiezmoFecharegistro()
    {
        return $this->datDiezmoFecharegistro;
    }

    /**
     * Set varDiezmoPeticion
     *
     * @param string $varDiezmoPeticion
     * @return Diezmos
     */
    public function setVarDiezmoPeticion($varDiezmoPeticion)
    {
        $this->varDiezmoPeticion = $varDiezmoPeticion;
    
        return $this;
    }

    /**
     * Get varDiezmoPeticion
     *
     * @return string 
     */
    public function getVarDiezmoPeticion()
    {
        return $this->varDiezmoPeticion;
    }

    /**
     * Set persona
     *
     * @param \AE\DataBundle\Entity\Persona $persona
     * @return Diezmos
     */
    public function setPersona(\AE\DataBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;
    
        return $this;
    }

    /**
     * Get persona
     *
     * @return \AE\DataBundle\Entity\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }
}