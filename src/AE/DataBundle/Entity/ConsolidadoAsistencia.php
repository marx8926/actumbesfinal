<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConsolidadoAsistencia
 *
 * @ORM\Table(name="consolidado_asistencia", indexes={@ORM\Index(name="IDX_9F5D000F2156FD83", columns={"tema_leche_id"}), @ORM\Index(name="IDX_9F5D000F8CE615FD", columns={"consolidar_id"})})
 * @ORM\Entity
 */
class ConsolidadoAsistencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="consolidado_asistencia_id_seq", allocationSize=1, initialValue=1)
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
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=300, nullable=true)
     */
    private $detalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="celula", type="integer", nullable=true)
     */
    private $celula = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="iglesia", type="integer", nullable=true)
     */
    private $iglesia = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="visita", type="integer", nullable=true)
     */
    private $visita = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="contacto", type="integer", nullable=true)
     */
    private $contacto = '0';

    /**
     * @var \TemaLeche
     *
     * @ORM\ManyToOne(targetEntity="TemaLeche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tema_leche_id", referencedColumnName="id")
     * })
     */
    private $temaLeche;

    /**
     * @var \Consolidar
     *
     * @ORM\ManyToOne(targetEntity="Consolidar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consolidar_id", referencedColumnName="int_consolidar_id")
     * })
     */
    private $consolidar;



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
     * @return ConsolidadoAsistencia
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
     * @return ConsolidadoAsistencia
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
     * @return ConsolidadoAsistencia
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
     * Set detalle
     *
     * @param string $detalle
     * @return ConsolidadoAsistencia
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
     * Set celula
     *
     * @param integer $celula
     * @return ConsolidadoAsistencia
     */
    public function setCelula($celula)
    {
        $this->celula = $celula;

        return $this;
    }

    /**
     * Get celula
     *
     * @return integer 
     */
    public function getCelula()
    {
        return $this->celula;
    }

    /**
     * Set iglesia
     *
     * @param integer $iglesia
     * @return ConsolidadoAsistencia
     */
    public function setIglesia($iglesia)
    {
        $this->iglesia = $iglesia;

        return $this;
    }

    /**
     * Get iglesia
     *
     * @return integer 
     */
    public function getIglesia()
    {
        return $this->iglesia;
    }

    /**
     * Set visita
     *
     * @param integer $visita
     * @return ConsolidadoAsistencia
     */
    public function setVisita($visita)
    {
        $this->visita = $visita;

        return $this;
    }

    /**
     * Get visita
     *
     * @return integer 
     */
    public function getVisita()
    {
        return $this->visita;
    }

    /**
     * Set contacto
     *
     * @param integer $contacto
     * @return ConsolidadoAsistencia
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return integer 
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set temaLeche
     *
     * @param \AE\DataBundle\Entity\TemaLeche $temaLeche
     * @return ConsolidadoAsistencia
     */
    public function setTemaLeche(\AE\DataBundle\Entity\TemaLeche $temaLeche = null)
    {
        $this->temaLeche = $temaLeche;

        return $this;
    }

    /**
     * Get temaLeche
     *
     * @return \AE\DataBundle\Entity\TemaLeche 
     */
    public function getTemaLeche()
    {
        return $this->temaLeche;
    }

    /**
     * Set consolidar
     *
     * @param \AE\DataBundle\Entity\Consolidar $consolidar
     * @return ConsolidadoAsistencia
     */
    public function setConsolidar(\AE\DataBundle\Entity\Consolidar $consolidar = null)
    {
        $this->consolidar = $consolidar;

        return $this;
    }

    /**
     * Get consolidar
     *
     * @return \AE\DataBundle\Entity\Consolidar 
     */
    public function getConsolidar()
    {
        return $this->consolidar;
    }
}
