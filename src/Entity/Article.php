<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $art_title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $art_desc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $art_pic = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $art_content = null;

    #[ORM\ManyToMany(targetEntity: Story::class, inversedBy: 'articles')]
    private Collection $story;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Writing::class)]
    private Collection $writings;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tag = null;

    public function __construct()
    {
        $this->story = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->writings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtTitle(): ?string
    {
        return $this->art_title;
    }

    public function setArtTitle(string $art_title): static
    {
        $this->art_title = $art_title;

        return $this;
    }

    public function getArtDesc(): ?string
    {
        return $this->art_desc;
    }

    public function setArtDesc(string $art_desc): static
    {
        $this->art_desc = $art_desc;

        return $this;
    }

    public function getArtPic(): ?string
    {
        return $this->art_pic;
    }

    public function setArtPic(?string $art_pic): static
    {
        $this->art_pic = $art_pic;

        return $this;
    }

    public function getArtContent(): ?string
    {
        return $this->art_content;
    }

    public function setArtContent(string $art_content): static
    {
        $this->art_content = $art_content;

        return $this;
    }

    /**
     * @return Collection<int, Story>
     */
    public function getStory(): Collection
    {
        return $this->story;
    }

    public function addStory(Story $story): static
    {
        if (!$this->story->contains($story)) {
            $this->story->add($story);
        }

        return $this;
    }

    public function removeStory(Story $story): static
    {
        $this->story->removeElement($story);

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

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Writing>
     */
    public function getWritings(): Collection
    {
        return $this->writings;
    }

    public function addWriting(Writing $writing): static
    {
        if (!$this->writings->contains($writing)) {
            $this->writings->add($writing);
            $writing->setArticle($this);
        }

        return $this;
    }

    public function removeWriting(Writing $writing): static
    {
        if ($this->writings->removeElement($writing)) {
            // set the owning side to null (unless already changed)
            if ($writing->getArticle() === $this) {
                $writing->setArticle(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->art_title;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }
}
