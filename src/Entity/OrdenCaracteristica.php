<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdenCaracteristicaRepository")
 */
class OrdenCaracteristica
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Orden", inversedBy="caracteristicas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orden;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Caracteristicas", inversedBy="ordenes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $caracteristica;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrden(): ?orden
    {
        return $this->orden;
    }

    public function setOrden(?orden $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    public function getCaracteristica(): ?caracteristicas
    {
        return $this->caracteristica;
    }

    public function setCaracteristica(?caracteristicas $caracteristica): self
    {
        $this->caracteristica = $caracteristica;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }
}
