<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Peticion
 *
 * @ORM\Table(name="peticion", indexes={@ORM\Index(name="fki_persona_peticion", columns={"persona_id"})})
 * @ORM\Entity
 */
class Peticion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="peticion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="var_peticion_motivooracion", type="string", length=300, nullable=true)
     */
    private $varPeticionMotivooracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_peticion_fecha", type="date", nullable=true)
     */
    private $datPeticionFecha;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set varPeticionMotivooracion
     *
     * @param string $varPeticionMotivooracion
     * @return Peticion
     */
    public function setVarPeticionMotivooracion($varPeticionMotivooracion)
    {
        $this->varPeticionMotivooracion = $varPeticionMotivooracion;

        return $this;
    }

    /**
     * Get varPeticionMotivooracion
     *
     * @return string 
     */
    public function getVarPeticionMotivooracion()
    {
        return $this->varPeticionMotivooracion;
    }

    /**
     * Set datPeticionFecha
     *
     * @param \DateTime $datPeticionFecha
     * @return Peticion
     */
    public function setDatPeticionFecha($datPeticionFecha)
    {
        $this->datPeticionFecha = $datPeticionFecha;

        return $this;
    }

    /**
     * Get datPeticionFecha
     *
     * @return \DateTime 
     */
    public function getDatPeticionFecha()
    {
        return $this->datPeticionFecha;
    }

    /**
     * Set persona
     *
     * @param \AE\DataBundle\Entity\Persona $persona
     * @return Peticion
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
