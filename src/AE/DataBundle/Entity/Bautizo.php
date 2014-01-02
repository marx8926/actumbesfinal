<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bautizo
 *
 * @ORM\Table(name="bautizo")
 * @ORM\Entity
 */
class Bautizo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="bautizo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="hora", type="string", length=20, nullable=true)
     */
    private $hora;

    /**
     * @var string
     *
     * @ORM\Column(name="pastor", type="string", length=200, nullable=true)
     */
    private $pastor;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar", type="string", length=200, nullable=true)
     */
    private $lugar;



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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Bautizo
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set hora
     *
     * @param string $hora
     * @return Bautizo
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return string 
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set pastor
     *
     * @param string $pastor
     * @return Bautizo
     */
    public function setPastor($pastor)
    {
        $this->pastor = $pastor;

        return $this;
    }

    /**
     * Get pastor
     *
     * @return string 
     */
    public function getPastor()
    {
        return $this->pastor;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return Bautizo
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }
}
