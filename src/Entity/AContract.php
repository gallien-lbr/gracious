<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AContractRepository")
 */
class AContract
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SelectField",mappedBy="contract")
     */
    private $selectFields;

    public function __construct()
    {
        $this->selectFields = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|SelectField[]
     */
    public function getSelectFields(): Collection
    {
        return $this->selectFields;
    }

    public function addSelectField(SelectField $selectField): self
    {
        if (!$this->selectFields->contains($selectField)) {
            $this->selectFields[] = $selectField;
            $selectField->setContract($this);
        }

        return $this;
    }

    public function removeSelectField(SelectField $selectField): self
    {
        if ($this->selectFields->contains($selectField)) {
            $this->selectFields->removeElement($selectField);
            // set the owning side to null (unless already changed)
            if ($selectField->getContract() === $this) {
                $selectField->setContract(null);
            }
        }

        return $this;
    }
}
