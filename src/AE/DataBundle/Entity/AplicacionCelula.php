<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AplicacionCelula
 *
 * @ORM\Table(name="aplicacion_celula", indexes={@ORM\Index(name="IDX_BF237CFD4A4DABFB", columns={"celula_id"}), @ORM\Index(name="IDX_BF237CFD79C7128D", columns={"tema_celula"})})
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
    private $invitados = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="asistentes", type="integer", nullable=true)
     */
    private $asistentes = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nuevos_convertidos", type="integer", nullable=true)
     */
    private $nuevosConvertidos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="asistencia_culto", type="integer", nullable=true)
     */
    private $asistenciaCulto = '0';

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
     * Set asistentes
     *
     * @param integer $asistentes
     * @return AplicacionCelula
     */
    public function setAsistentes($asistentes)
    {
        $this->asistentes = $asistentes;

        return $this;
    }

    /**
     * Get asistentes
     *
     * @return integer 
     */
    public function getAsistentes()
    {
        return $this->asistentes;
    }

    /**
     * Set nuevosConvertidos
     *
     * @param integer $nuevosConvertidos
     * @return AplicacionCelula
     */
    public function setNuevosConvertidos($nuevosConvertidos)
    {
        $this->nuevosConvertidos = $nuevosConvertidos;

        return $this;
    }

    /**
     * Get nuevosConvertidos
     *
     * @return integer 
     */
    public function getNuevosConvertidos()
    {
        return $this->nuevosConvertidos;
    }

    /**
     * Set asistenciaCulto
     *
     * @param integer $asistenciaCulto
     * @return AplicacionCelula
     */
    public function setAsistenciaCulto($asistenciaCulto)
    {
        $this->asistenciaCulto = $asistenciaCulto;

        return $this;
    }

    /**
     * Get asistenciaCulto
     *
     * @return integer 
     */
    public function getAsistenciaCulto()
    {
        return $this->asistenciaCulto;
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
}
