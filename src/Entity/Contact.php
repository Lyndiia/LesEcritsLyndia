<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cont_name = null;

    #[ORM\Column(length: 255)]
    private ?string $cont_email = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $cont_content = null;

    #[ORM\ManyToOne(inversedBy: 'contacts')]
    private ?User $cont_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContName(): ?string
    {
        return $this->cont_name;
    }

    public function setContName(string $cont_name): static
    {
        $this->cont_name = $cont_name;

        return $this;
    }

    public function getContEmail(): ?string
    {
        return $this->cont_email;
    }

    public function setContEmail(string $cont_email): static
    {
        $this->cont_email = $cont_email;

        return $this;
    }

    public function getContContent(): ?string
    {
        return $this->cont_content;
    }

    public function setContContent(string $cont_content): static
    {
        $this->cont_content = $cont_content;

        return $this;
    }

    public function getContUser(): ?User
    {
        return $this->cont_user;
    }

    public function setContUser(?User $cont_user): static
    {
        $this->cont_user = $cont_user;

        return $this;
    }
}
