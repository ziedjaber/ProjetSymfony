<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    /**
     * @var Collection<int, Bateau>
     */
    #[ORM\OneToMany(targetEntity: Bateau::class, mappedBy: 'category')]
    private Collection $IdCategory;

    public function __construct()
    {
        $this->IdCategory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection<int, Bateau>
     */
    public function getIdCategory(): Collection
    {
        return $this->IdCategory;
    }

    public function addIdCategory(Bateau $idCategory): static
    {
        if (!$this->IdCategory->contains($idCategory)) {
            $this->IdCategory->add($idCategory);
            $idCategory->setCategory($this);
        }

        return $this;
    }

    public function removeIdCategory(Bateau $idCategory): static
    {
        if ($this->IdCategory->removeElement($idCategory)) {
            // set the owning side to null (unless already changed)
            if ($idCategory->getCategory() === $this) {
                $idCategory->setCategory(null);
            }
        }

        return $this;
    }
}
