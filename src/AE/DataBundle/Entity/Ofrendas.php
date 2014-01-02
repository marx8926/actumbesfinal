<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ofrendas
 *
 * @ORM\Table(name="ofrendas", indexes={@ORM\Index(name="fki_celula_ofrenda", columns={"celula_id"}), @ORM\Index(name="index_ofrendas_on_turno_id", columns={"servicio_id"}), @ORM\Index(name="fki_sesion_pca", columns={"sesion_pca"}), @ORM\Index(name="fki_aplicacion_celula", columns={"aplicacion_celula"})})
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
     * @var string
     *
     * @ORM\Column(name="dec_ofrenda_monto", type="decimal", precision=18, scale=2, nullable=true)
     */
    private $decOfrendaMonto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dec_ofrenda_fecharegistro", type="datetime", nullable=true)
     */
    private $decOfrendaFecharegistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="celula_id", type="bigint", nullable=true)
     */
    private $celulaId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_verificacion", type="datetime", nullable=true)
     */
    private $fechaVerificacion;

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
     * @var \SesionPca
     *
     * @ORM\ManyToOne(targetEntity="SesionPca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sesion_pca", referencedColumnName="id")
     * })
     */
    private $sesionPca;

    /**
     * @var \AplicacionCelula
     *
     * @ORM\ManyToOne(targetEntity="AplicacionCelula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aplicacion_celula", referencedColumnName="id")
     * })
     */
    private $aplicacionCelula;



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
     * @param string $decOfrendaMonto
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
     * @return string 
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
     * Set celulaId
     *
     * @param integer $celulaId
     * @return Ofrendas
     */
    public function setCelulaId($celulaId)
    {
        $this->celulaId = $celulaId;

        return $this;
    }

    /**
     * Get celulaId
     *
     * @return integer 
     */
    public function getCelulaId()
    {
        return $this->celulaId;
    }

    /**
     * Set fechaVerificacion
     *
     * @param \DateTime $fechaVerificacion
     * @return Ofrendas
     */
    public function setFechaVerificacion($fechaVerificacion)
    {
        $this->fechaVerificacion = $fechaVerificacion;

        return $this;
    }

    /**
     * Get fechaVerificacion
     *
     * @return \DateTime 
     */
    public function getFechaVerificacion()
    {
        return $this->fechaVerificacion;
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

    /**
     * Set sesionPca
     *
     * @param \AE\DataBundle\Entity\SesionPca $sesionPca
     * @return Ofrendas
     */
    public function setSesionPca(\AE\DataBundle\Entity\SesionPca $sesionPca = null)
    {
        $this->sesionPca = $sesionPca;

        return $this;
    }

    /**
     * Get sesionPca
     *
     * @return \AE\DataBundle\Entity\SesionPca 
     */
    public function getSesionPca()
    {
        return $this->sesionPca;
    }

    /**
     * Set aplicacionCelula
     *
     * @param \AE\DataBundle\Entity\AplicacionCelula $aplicacionCelula
     * @return Ofrendas
     */
    public function setAplicacionCelula(\AE\DataBundle\Entity\AplicacionCelula $aplicacionCelula = null)
    {
        $this->aplicacionCelula = $aplicacionCelula;

        return $this;
    }

    /**
     * Get aplicacionCelula
     *
     * @return \AE\DataBundle\Entity\AplicacionCelula 
     */
    public function getAplicacionCelula()
    {
        return $this->aplicacionCelula;
    }
}
