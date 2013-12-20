<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsistenciaCelula
 *
 * @ORM\Table(name="asistencia_celula", indexes={@ORM\Index(name="IDX_AD17BD66988B2EC5", columns={"aplicacion_cell_id"}), @ORM\Index(name="IDX_AD17BD66F5F88DB9", columns={"persona_id"})})
 * @ORM\Entity
 */
class AsistenciaCelula
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="asistencia_celula_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asistio", type="boolean", nullable=true)
     */
    private $asistio = 'false';

    /**
     * @var \AplicacionCelula
     *
     * @ORM\ManyToOne(targetEntity="AplicacionCelula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aplicacion_cell_id", referencedColumnName="id")
     * })
     */
    private $aplicacionCell;

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
     * Set asistio
     *
     * @param boolean $asistio
     * @return AsistenciaCelula
     */
    public function setAsistio($asistio)
    {
        $this->asistio = $asistio;

        return $this;
    }

    /**
     * Get asistio
     *
     * @return boolean 
     */
    public function getAsistio()
    {
        return $this->asistio;
    }

    /**
     * Set aplicacionCell
     *
     * @param \AE\DataBundle\Entity\AplicacionCelula $aplicacionCell
     * @return AsistenciaCelula
     */
    public function setAplicacionCell(\AE\DataBundle\Entity\AplicacionCelula $aplicacionCell = null)
    {
        $this->aplicacionCell = $aplicacionCell;

        return $this;
    }

    /**
     * Get aplicacionCell
     *
     * @return \AE\DataBundle\Entity\AplicacionCelula 
     */
    public function getAplicacionCell()
    {
        return $this->aplicacionCell;
    }

    /**
     * Set persona
     *
     * @param \AE\DataBundle\Entity\Persona $persona
     * @return AsistenciaCelula
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
