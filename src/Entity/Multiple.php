<?php

namespace App\Entity;

use App\Repository\MultipleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultipleRepository::class)]
class Multiple
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomnom;

    #[ORM\ManyToMany(targetEntity: Choix::class, inversedBy: 'multiples')]
    private $choix;

    public function __construct()
    {
        $this->choix = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomnom(): ?string
    {
        return $this->nomnom;
    }

    public function setNomnom(string $nomnom): self
    {
        $this->nomnom = $nomnom;

        return $this;
    }

    /**
     * @return Collection<int, Choix>
     */
    public function getChoix(): Collection
    {
        return $this->choix;
    }

    public function addChoix(Choix $choix): self
    {
        if (!$this->choix->contains($choix)) {
            $this->choix[] = $choix;
        }

        return $this;
    }

    public function removeChoix(Choix $choix): self
    {
        $this->choix->removeElement($choix);

        return $this;
    }
}
