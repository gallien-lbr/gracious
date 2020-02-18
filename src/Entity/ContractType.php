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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $isCreated;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ContractField",inversedBy="contractType")
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



    /**
     * @return mixed
     */
    public function getIsCreated()
    {
        return $this->isCreated;
    }

    /**
     * @param mixed $isCreated
     */
    public function setIsCreated($isCreated): void
    {
        $this->isCreated = $isCreated;
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



}
