<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SesionPca
 *
 * @ORM\Table(name="sesion_pca")
 * @ORM\Entity
 */
class SesionPca
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sesion_pca_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="aplicacion", type="date", nullable=true)
     */
    private $aplicacion;

    /**
     * @var float
     *
     * @ORM\Column(name="ofrenda", type="float", nullable=true)
     */
    private $ofrenda;

    /**
     * @var \TemaCurso
     *
     * @ORM\ManyToOne(targetEntity="TemaCurso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="temacurso_id", referencedColumnName="id")
     * })
     */
    private $temacurso;

    /**
     * @var \DetallePca
     *
     * @ORM\ManyToOne(targetEntity="DetallePca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="detalle_pca", referencedColumnName="id")
     * })
     */
    private $detallePca;



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
     * @return SesionPca
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
     * Set aplicacion
     *
     * @param \DateTime $aplicacion
     * @return SesionPca
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
     * Set ofrenda
     *
     * @param float $ofrenda
     * @return SesionPca
     */
    public function setOfrenda($ofrenda)
    {
        $this->ofrenda = $ofrenda;
    
        return $this;
    }

    /**
     * Get ofrenda
     *
     * @return float 
     */
    public function getOfrenda()
    {
        return $this->ofrenda;
    }

    /**
     * Set temacurso
     *
     * @param \AE\DataBundle\Entity\TemaCurso $temacurso
     * @return SesionPca
     */
    public function setTemacurso(\AE\DataBundle\Entity\TemaCurso $temacurso = null)
    {
        $this->temacurso = $temacurso;
    
        return $this;
    }

    /**
     * Get temacurso
     *
     * @return \AE\DataBundle\Entity\TemaCurso 
     */
    public function getTemacurso()
    {
        return $this->temacurso;
    }

    /**
     * Set detallePca
     *
     * @param \AE\DataBundle\Entity\DetallePca $detallePca
     * @return SesionPca
     */
    public function setDetallePca(\AE\DataBundle\Entity\DetallePca $detallePca = null)
    {
        $this->detallePca = $detallePca;
    
        return $this;
    }

    /**
     * Get detallePca
     *
     * @return \AE\DataBundle\Entity\DetallePca 
     */
    public function getDetallePca()
    {
        return $this->detallePca;
    }
}