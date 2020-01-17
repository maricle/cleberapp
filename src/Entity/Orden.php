<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orden
 *
 * @ORM\Table(name="orden", indexes={@ORM\Index(name="fk_orden_persona1_idx", columns={"persona_id"}), @ORM\Index(name="fk_orden_estadotrabajo1_idx", columns={"estadotrabajo_id"})})
 * @ORM\Entity
 */
class Orden
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero", type="string", length=45, nullable=true)
     */
    private $numero;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var int|null
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=true)
     */
    private $prioridad;

    /**
     * @var \Estadotrabajo
     *
     * @ORM\ManyToOne(targetEntity="Estadotrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estadotrabajo_id", referencedColumnName="id")
     * })
     */
    private $estadotrabajo;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * })
     */
    private $persona;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getPrioridad(): ?int
    {
        return $this->prioridad;
    }

    public function setPrioridad(?int $prioridad): self
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    public function getEstadotrabajo(): ?Estadotrabajo
    {
        return $this->estadotrabajo;
    }

    public function setEstadotrabajo(?Estadotrabajo $estadotrabajo): self
    {
        $this->estadotrabajo = $estadotrabajo;

        return $this;
    }

    public function getPersona(): ?Persona
    {
        return $this->persona;
    }

    public function setPersona(?Persona $persona): self
    {
        $this->persona = $persona;

        return $this;
    }

 public function __toString() {
        return (string) $this->numero;
    }
}
