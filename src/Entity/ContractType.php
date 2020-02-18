<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractTypeRepository")
 */
class ContractType
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
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isCreated;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ContractField",inversedBy="contractType",cascade={"persist"})
     */
    private $fields;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }


    public function getFields()
    {
        return $this->fields;
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function addField(ContractField $field): self
    {
        if (!$this->fields->contains($field)) {
            $this->fields[] = $field;
        }

        return $this;
    }

    public function removeField(ContractField $field): self
    {
        if ($this->fields->contains($field)) {
            $this->fields->removeElement($field);
        }

        return $this;
    }

    public function getIsCreated(): ?bool
    {
        return $this->isCreated;
    }

    public function setIsCreated(?bool $isCreated): self
    {
        $this->isCreated = $isCreated;

        return $this;
    }

    public function __toString(){
        return $this->getName();
    }


}
