<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AplicacionCelula
 *
 * @ORM\Table(name="aplicacion_celula", indexes={@ORM\Index(name="IDX_BF237CFD4A4DABFB", columns={"celula_id"}), @ORM\Index(name="IDX_BF237CFD79C7128D", columns={"tema_celula"}), @ORM\Index(name="IDX_BF237CFD9F3209E9", columns={"ofrenda_id"})})
 * @ORM\Entity
 */
class AplicacionCelula
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="aplicacion_celula_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date", nullable=true)
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="limite", type="date", nullable=true)
     */
    private $limite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aplicacion", type="date", nullable=true)
     */
    private $aplicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=150, nullable=true)
     */
    private $detalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="invitados", type="integer", nullable=true)
     */
    private $invitados;

    /**
     * @var \Celula
     *
     * @ORM\ManyToOne(targetEntity="Celula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="celula_id", referencedColumnName="id")
     * })
     */
    private $celula;

    /**
     * @var \TemaCelula
     *
     * @ORM\ManyToOne(targetEntity="TemaCelula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tema_celula", referencedColumnName="id")
     * })
     */
    private $temaCelula;

    /**
     * @var \Ofrendas
     *
     * @ORM\ManyToOne(targetEntity="Ofrendas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ofrenda_id", referencedColumnName="int_ofrenda_id")
     * })
     */
    private $ofrenda;



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
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return AplicacionCelula
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
     * Set limite
     *
     * @param \DateTime $limite
     * @return AplicacionCelula
     */
    public function setLimite($limite)
    {
        $this->limite = $limite;

        return $this;
    }

    /**
     * Get limite
     *
     * @return \DateTime 
     */
    public function getLimite()
    {
        return $this->limite;
    }

    /**
     * Set aplicacion
     *
     * @param \DateTime $aplicacion
     * @return AplicacionCelula
     */
    public function setAplicacion($aplicacion)
    {
        $this->aplicacion = $aplicacion;

        return $this;
    }

    /**
     * Get aplicacion
     *
     * @return \DateTime 
     */
    public function getAplicacion()
    {
        return $this->aplicacion;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     * @return AplicacionCelula
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set invitados
     *
     * @param integer $invitados
     * @return AplicacionCelula
     */
    public function setInvitados($invitados)
    {
        $this->invitados = $invitados;

        return $this;
    }

    /**
     * Get invitados
     *
     * @return integer 
     */
    public function getInvitados()
    {
        return $this->invitados;
    }

    /**
     * Set celula
     *
     * @param \AE\DataBundle\Entity\Celula $celula
     * @return AplicacionCelula
     */
    public function setCelula(\AE\DataBundle\Entity\Celula $celula = null)
    {
        $this->celula = $celula;

        return $this;
    }

    /**
     * Get celula
     *
     * @return \AE\DataBundle\Entity\Celula 
     */
    public function getCelula()
    {
        return $this->celula;
    }

    /**
     * Set temaCelula
     *
     * @param \AE\DataBundle\Entity\TemaCelula $temaCelula
     * @return AplicacionCelula
     */
    public function setTemaCelula(\AE\DataBundle\Entity\TemaCelula $temaCelula = null)
    {
        $this->temaCelula = $temaCelula;

        return $this;
    }

    /**
     * Get temaCelula
     *
     * @return \AE\DataBundle\Entity\TemaCelula 
     */
    public function getTemaCelula()
    {
        return $this->temaCelula;
    }

    /**
     * Set ofrenda
     *
     * @param \AE\DataBundle\Entity\Ofrendas $ofrenda
     * @return AplicacionCelula
     */
    public function setOfrenda(\AE\DataBundle\Entity\Ofrendas $ofrenda = null)
    {
        $this->ofrenda = $ofrenda;

        return $this;
    }

    /**
     * Get ofrenda
     *
     * @return \AE\DataBundle\Entity\Ofrendas 
     */
    public function getOfrenda()
    {
        return $this->ofrenda;
    }
}
