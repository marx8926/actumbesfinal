<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TemaLeche
 *
 * @ORM\Table(name="tema_leche")
 * @ORM\Entity
 */
class TemaLeche
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tema_leche_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100, nullable=true)
     */
    private $titulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=true)
     */
    private $tipo;

    /**
     * @var \LecheEspiritual
     *
     * @ORM\ManyToOne(targetEntity="LecheEspiritual")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_leche_espiritual", referencedColumnName="id")
     * })
     */
    private $idLecheEspiritual;



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
     * Set titulo
     *
     * @param string $titulo
     * @return TemaLeche
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return TemaLeche
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set idLecheEspiritual
     *
     * @param \AE\DataBundle\Entity\LecheEspiritual $idLecheEspiritual
     * @return TemaLeche
     */
    public function setIdLecheEspiritual(\AE\DataBundle\Entity\LecheEspiritual $idLecheEspiritual = null)
    {
        $this->idLecheEspiritual = $idLecheEspiritual;
    
        return $this;
    }

    /**
     * Get idLecheEspiritual
     *
     * @return \AE\DataBundle\Entity\LecheEspiritual 
     */
    public function getIdLecheEspiritual()
    {
        return $this->idLecheEspiritual;
    }
}