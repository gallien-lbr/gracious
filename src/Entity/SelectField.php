<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SelectFieldRepository")
 */
class SelectField
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AContract", inversedBy="fields")
     */
    private $contract;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractField")
     */
    private $contractField;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContract(): ?AContract
    {
        return $this->contract;
    }

    public function setContract(?AContract $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    public function getContractField(): ?ContractField
    {
        return $this->contractField;
    }

    public function setContractField(?ContractField $contractField): self
    {
        $this->contractField = $contractField;

        return $this;
    }
}
