<?php

namespace App\Entity;

use App\Repository\LibraryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibraryRepository::class)]
class Library
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Story::class, inversedBy: 'libraries')]
    private Collection $lib_read;

    #[ORM\OneToOne(inversedBy: 'library', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'user_id_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user_id = null;

    #[ORM\OneToOne(mappedBy: 'library', cascade: ['persist', 'remove'])]
    private ?Info $info = null;
    

    public function __construct()
    {
        $this->lib_read = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Story>
     */
    public function getLibRead(): Collection
    {
        return $this->lib_read;
    }

    public function addLibRead(Story $libRead): static
    {
        if (!$this->lib_read->contains($libRead)) {
            $this->lib_read->add($libRead);
        }

        return $this;
    }

    public function removeLibRead(Story $libRead): static
    {
        $this->lib_read->removeElement($libRead);

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getInfo(): ?Info
    {
        return $this->info;
    }

    public function setInfo(Info $info): static
    {
        // set the owning side of the relation if necessary
        if ($info->getLibrary() !== $this) {
            $info->setLibrary($this);
        }

        $this->info = $info;

        return $this;
    }

    public function __toString()
    {
        return $this->lib_read;
        
    }

}
