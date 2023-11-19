<?php

namespace App\Entity;

use App\Repository\WritingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WritingRepository::class)]
class Writing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $writ_content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $writ_attachment = null;

    #[ORM\ManyToOne(inversedBy: 'writings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userSend = null;

    #[ORM\ManyToOne(inversedBy: 'writings')]
    private ?Article $article = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWritContent(): ?string
    {
        return $this->writ_content;
    }

    public function setWritContent(string $writ_content): static
    {
        $this->writ_content = $writ_content;

        return $this;
    }

    public function getWritAttachment(): ?string
    {
        return $this->writ_attachment;
    }

    public function setWritAttachment(?string $writ_attachment): static
    {
        $this->writ_attachment = $writ_attachment;

        return $this;
    }

    public function getUserSend(): ?User
    {
        return $this->userSend;
    }

    public function setUserSend(?User $userSend): static
    {
        $this->userSend = $userSend;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }
}
