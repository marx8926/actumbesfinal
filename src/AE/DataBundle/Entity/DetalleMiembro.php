<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetalleMiembro
 *
 * @ORM\Table(name="detalle_miembro", indexes={@ORM\Index(name="fki_persona", columns={"persona_id"}), @ORM\Index(name="fki_bautizo", columns={"bautizo_id"}), @ORM\Index(name="fk_lider", columns={"lider_id"}), @ORM\Index(name="fki_celula_miembro", columns={"celula_id"}), @ORM\Index(name="fki_encuentro_miembro", columns={"encuentro_id"}), @ORM\Index(name="fki_celula_discipulado", columns={"celula_dis_id"}), @ORM\Index(name="IDX_3E1ED718BBE8922", columns={"red_id"})})
 * @ORM\Entity
 */
class DetalleMiembro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="detalle_miembro_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo = 'true';

    /**
     * @var integer
     *
     * @ORM\Column(name="consolidador_id", type="bigint", nullable=true)
     */
    private $consolidadorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lider_id", type="bigint", nullable=true)
     */
    private $liderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="ganado_por", type="bigint", nullable=true)
     */
    private $ganadoPor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="convertido", type="date", nullable=true)
     */
    private $convertido;

    /**
     * @var \Red
     *
     * @ORM\ManyToOne(targetEntity="Red")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="red_id", referencedColumnName="int_red_id")
     * })
     */
    private $red;

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
     * @var \Celula
     *
     * @ORM\ManyToOne(targetEntity="Celula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="celula_dis_id", referencedColumnName="id")
     * })
     */
    private $celulaDis;

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
     * @var \Bautizo
     *
     * @ORM\ManyToOne(targetEntity="Bautizo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bautizo_id", referencedColumnName="id")
     * })
     */
    private $bautizo;

    /**
     * @var \DetalleMiembro
     *
     * @ORM\ManyToOne(targetEntity="DetalleMiembro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="encuentro_id", referencedColumnName="id")
     * })
     */
    private $encuentro;



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
     * Set activo
     *
     * @param boolean $activo
     * @return DetalleMiembro
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set consolidadorId
     *
     * @param integer $consolidadorId
     * @return DetalleMiembro
     */
    public function setConsolidadorId($consolidadorId)
    {
        $this->consolidadorId = $consolidadorId;

        return $this;
    }

    /**
     * Get consolidadorId
     *
     * @return integer 
     */
    public function getConsolidadorId()
    {
        return $this->consolidadorId;
    }

    /**
     * Set liderId
     *
     * @param integer $liderId
     * @return DetalleMiembro
     */
    public function setLiderId($liderId)
    {
        $this->liderId = $liderId;

        return $this;
    }

    /**
     * Get liderId
     *
     * @return integer 
     */
    public function getLiderId()
    {
        return $this->liderId;
    }

    /**
     * Set ganadoPor
     *
     * @param integer $ganadoPor
     * @return DetalleMiembro
     */
    public function setGanadoPor($ganadoPor)
    {
        $this->ganadoPor = $ganadoPor;

        return $this;
    }

    /**
     * Get ganadoPor
     *
     * @return integer 
     */
    public function getGanadoPor()
    {
        return $this->ganadoPor;
    }

    /**
     * Set convertido
     *
     * @param \DateTime $convertido
     * @return DetalleMiembro
     */
    public function setConvertido($convertido)
    {
        $this->convertido = $convertido;

        return $this;
    }

    /**
     * Get convertido
     *
     * @return \DateTime 
     */
    public function getConvertido()
    {
        return $this->convertido;
    }

    /**
     * Set red
     *
     * @param \AE\DataBundle\Entity\Red $red
     * @return DetalleMiembro
     */
    public function setRed(\AE\DataBundle\Entity\Red $red = null)
    {
        $this->red = $red;

        return $this;
    }

    /**
     * Get red
     *
     * @return \AE\DataBundle\Entity\Red 
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * Set celula
     *
     * @param \AE\DataBundle\Entity\Celula $celula
     * @return DetalleMiembro
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
     * Set celulaDis
     *
     * @param \AE\DataBundle\Entity\Celula $celulaDis
     * @return DetalleMiembro
     */
    public function setCelulaDis(\AE\DataBundle\Entity\Celula $celulaDis = null)
    {
        $this->celulaDis = $celulaDis;

        return $this;
    }

    /**
     * Get celulaDis
     *
     * @return \AE\DataBundle\Entity\Celula 
     */
    public function getCelulaDis()
    {
        return $this->celulaDis;
    }

    /**
     * Set persona
     *
     * @param \AE\DataBundle\Entity\Persona $persona
     * @return DetalleMiembro
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

    /**
     * Set bautizo
     *
     * @param \AE\DataBundle\Entity\Bautizo $bautizo
     * @return DetalleMiembro
     */
    public function setBautizo(\AE\DataBundle\Entity\Bautizo $bautizo = null)
    {
        $this->bautizo = $bautizo;

        return $this;
    }

    /**
     * Get bautizo
     *
     * @return \AE\DataBundle\Entity\Bautizo 
     */
    public function getBautizo()
    {
        return $this->bautizo;
    }

    /**
     * Set encuentro
     *
     * @param \AE\DataBundle\Entity\DetalleMiembro $encuentro
     * @return DetalleMiembro
     */
    public function setEncuentro(\AE\DataBundle\Entity\DetalleMiembro $encuentro = null)
    {
        $this->encuentro = $encuentro;

        return $this;
    }

    /**
     * Get encuentro
     *
     * @return \AE\DataBundle\Entity\DetalleMiembro 
     */
    public function getEncuentro()
    {
        return $this->encuentro;
    }
}
