<?php

namespace App\Entity;

use App\Repository\ChapterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapterRepository::class)]
class Chapter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $chap_title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $chap_content = null;

    #[ORM\ManyToOne(inversedBy: 'chapters')]
    private ?Story $story = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChapTitle(): ?string
    {
        return $this->chap_title;
    }

    public function setChapTitle(string $chap_title): static
    {
        $this->chap_title = $chap_title;

        return $this;
    }

    public function getChapContent(): ?string
    {
        return $this->chap_content;
    }

    public function setChapContent(string $chap_content): static
    {
        $this->chap_content = $chap_content;

        return $this;
    }

    public function getStory(): ?Story
    {
        return $this->story;
    }

    public function setStory(?Story $story): static
    {
        $this->story = $story;

        return $this;
    }
}
