<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristicas
 *
 * @ORM\Table(name="caracteristicas", indexes={@ORM\Index(name="fk_caracteristicas_tipodetrabajo1_idx", columns={"tipodetrabajo_id"})})
 * @ORM\Entity
 */
class Caracteristicas {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="costro", type="string", length=45, nullable=true)
     */
    private $costro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="valor", type="string", length=45, nullable=true)
     */
    private $valor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tipocalculo", type="string", length=45, nullable=true)
     */
    private $tipocalculo;

    /**
     * @var \Tipodetrabajo
     *
     * @ORM\ManyToOne(targetEntity="Tipodetrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipodetrabajo_id", referencedColumnName="id")
     * })
     */
    private $tipodetrabajo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrdenCaracteristica", mappedBy="caracteristica", orphanRemoval=true)
     */
    private $ordenes;

    public function __construct()
    {
        $this->ordenes = new ArrayCollection();
    }

   

    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCostro(): ?string {
        return $this->costro;
    }

    public function setCostro(?string $costro): self {
        $this->costro = $costro;

        return $this;
    }

    public function getValor(): ?string {
        return $this->valor;
    }

    public function setValor(?string $valor): self {
        $this->valor = $valor;

        return $this;
    }

    public function getTipocalculo(): ?string {
        return $this->tipocalculo;
    }

    public function setTipocalculo(?string $tipocalculo): self {
        $this->tipocalculo = $tipocalculo;

        return $this;
    }

    public function getTipodetrabajo(): ?Tipodetrabajo {
        return $this->tipodetrabajo;
    }

    public function setTipodetrabajo(?Tipodetrabajo $tipodetrabajo): self {
        $this->tipodetrabajo = $tipodetrabajo;

        return $this;
    }

    public function __toString() {
        return (string) $this->nombre;
    }

    /**
     * @return Collection|OrdenCaracteristica[]
     */
    public function getOrdenes(): Collection
    {
        return $this->ordenes;
    }

    public function addOrdene(OrdenCaracteristica $ordene): self
    {
        if (!$this->ordenes->contains($ordene)) {
            $this->ordenes[] = $ordene;
            $ordene->setCaracteristica($this);
        }

        return $this;
    }

    public function removeOrdene(OrdenCaracteristica $ordene): self
    {
        if ($this->ordenes->contains($ordene)) {
            $this->ordenes->removeElement($ordene);
            // set the owning side to null (unless already changed)
            if ($ordene->getCaracteristica() === $this) {
                $ordene->setCaracteristica(null);
            }
        }

        return $this;
    }

   
}
