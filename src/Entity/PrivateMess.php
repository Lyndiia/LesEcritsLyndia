<?php

namespace App\Entity;

use App\Repository\PrivateMessRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrivateMessRepository::class)]
class PrivateMess
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mess_title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mess_content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?bool $is_read = null;

    #[ORM\ManyToOne(inversedBy: 'sent')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $sender = null;

    #[ORM\ManyToOne(inversedBy: 'received')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $recipient = null;

    public function __construct()
    {
        $this->created_at = New \DateTimeImmutable();
        $this->is_read = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessTitle(): ?string
    {
        return $this->mess_title;
    }

    public function setMessTitle(?string $mess_title): static
    {
        $this->mess_title = $mess_title;

        return $this;
    }

    public function getMessContent(): ?string
    {
        return $this->mess_content;
    }

    public function setMessContent(string $mess_content): static
    {
        $this->mess_content = $mess_content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isIsRead(): ?bool
    {
        return $this->is_read;
    }

    public function setIsRead(bool $is_read): static
    {
        $this->is_read = $is_read;

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): static
    {
        $this->sender = $sender;

        return $this;
    }

    public function getRecipient(): ?User
    {
        return $this->recipient;
    }

    public function setRecipient(?User $recipient): static
    {
        $this->recipient = $recipient;

        return $this;
    }
}
