<?php

namespace App\Entity;

use App\Repository\InfoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoRepository::class)]
class Info
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $info_genre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $info_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $info_pic = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $info_desc = null;

    #[ORM\OneToOne(inversedBy: 'info', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id",nullable: false)]
    private ?User $user = null;

    #[ORM\OneToOne(inversedBy: 'info', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'library_id', referencedColumnName: 'id', nullable: false)]
    private ?Library $library = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInfoGenre(): ?string
    {
        return $this->info_genre;
    }

    public function setInfoGenre(?string $info_genre): static
    {
        $this->info_genre = $info_genre;

        return $this;
    }

    public function getInfoType(): ?string
    {
        return $this->info_type;
    }

    public function setInfoType(?string $info_type): static
    {
        $this->info_type = $info_type;

        return $this;
    }

    public function getInfoPic(): ?string
    {
        return $this->info_pic;
    }

    public function setInfoPic(?string $info_pic): static
    {
        $this->info_pic = $info_pic;

        return $this;
    }

    public function getInfoDesc(): ?string
    {
        return $this->info_desc;
    }

    public function setInfoDesc(?string $info_desc): static
    {
        $this->info_desc = $info_desc;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getLibrary(): ?Library
    {
        return $this->library;
    }

    public function setLibrary(Library $library): static
    {
        $this->library = $library;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
        
    }
}
