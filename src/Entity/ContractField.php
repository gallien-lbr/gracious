<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractFieldRepository")
 */
class ContractField
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ContractType",mappedBy="fields")
     */
    private $contractType;

    public function __construct()
    {
        $this->contractType = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFType(): ?string
    {
        return $this->fType;
    }

    public function setFType(string $fType): self
    {
        $this->fType = $fType;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ContractType[]
     */
    public function getContractType(): Collection
    {
        return $this->contractType;
    }

    public function addContractType(ContractType $contractType): self
    {
        if (!$this->contractType->contains($contractType)) {
            $this->contractType[] = $contractType;
            $contractType->addField($this);
        }

        return $this;
    }

    public function removeContractType(ContractType $contractType): self
    {
        if ($this->contractType->contains($contractType)) {
            $this->contractType->removeElement($contractType);
            $contractType->removeField($this);
        }

        return $this;
    }
}
