<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consolidar
 *
 * @ORM\Table(name="consolidar")
 * @ORM\Entity
 */
class Consolidar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_consolidar_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="consolidar_int_consolidar_id_seq", allocationSize=1, initialValue=1)
     */
    private $intConsolidarId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date", nullable=true)
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="date", nullable=true)
     */
    private $fin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pausa", type="date", nullable=true)
     */
    private $pausa;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consolidado_id", referencedColumnName="id")
     * })
     */
    private $consolidado;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consolidador_id", referencedColumnName="id")
     * })
     */
    private $consolidador;



    /**
     * Get intConsolidarId
     *
     * @return integer 
     */
    public function getIntConsolidarId()
    {
        return $this->intConsolidarId;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return Consolidar
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    
        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime 
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     * @return Consolidar
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    
        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set pausa
     *
     * @param \DateTime $pausa
     * @return Consolidar
     */
    public function setPausa($pausa)
    {
        $this->pausa = $pausa;
    
        return $this;
    }

    /**
     * Get pausa
     *
     * @return \DateTime 
     */
    public function getPausa()
    {
        return $this->pausa;
    }

    /**
     * Set consolidado
     *
     * @param \AE\DataBundle\Entity\Persona $consolidado
     * @return Consolidar
     */
    public function setConsolidado(\AE\DataBundle\Entity\Persona $consolidado = null)
    {
        $this->consolidado = $consolidado;
    
        return $this;
    }

    /**
     * Get consolidado
     *
     * @return \AE\DataBundle\Entity\Persona 
     */
    public function getConsolidado()
    {
        return $this->consolidado;
    }

    /**
     * Set consolidador
     *
     * @param \AE\DataBundle\Entity\Persona $consolidador
     * @return Consolidar
     */
    public function setConsolidador(\AE\DataBundle\Entity\Persona $consolidador = null)
    {
        $this->consolidador = $consolidador;
    
        return $this;
    }

    /**
     * Get consolidador
     *
     * @return \AE\DataBundle\Entity\Persona 
     */
    public function getConsolidador()
    {
        return $this->consolidador;
    }
}