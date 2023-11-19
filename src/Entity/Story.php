<?php

namespace App\Entity;

use App\Repository\StoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoryRepository::class)]
class Story
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $story_title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $story_genre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $story_pic = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $story_desc = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $story_content = null;

    #[ORM\OneToMany(mappedBy: 'story', targetEntity: Chapter::class)]
    private Collection $chapters;

    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'story')]
    private Collection $articles;

    #[ORM\ManyToMany(targetEntity: Library::class, mappedBy: 'lib_read')]
    private Collection $libraries;




    public function __construct()
    {
        $this->chapters = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->libraries = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStoryTitle(): ?string
    {
        return $this->story_title;
    }

    public function setStoryTitle(string $story_title): static
    {
        $this->story_title = $story_title;

        return $this;
    }

    public function getStoryGenre(): ?string
    {
        return $this->story_genre;
    }

    public function setStoryGenre(?string $story_genre): static
    {
        $this->story_genre = $story_genre;

        return $this;
    }

    public function getStoryPic(): ?string
    {
        return $this->story_pic;
    }

    public function setStoryPic(?string $story_pic): static
    {
        $this->story_pic = $story_pic;

        return $this;
    }

    public function getStoryDesc(): ?string
    {
        return $this->story_desc;
    }

    public function setStoryDesc(string $story_desc): static
    {
        $this->story_desc = $story_desc;

        return $this;
    }

    public function getStoryContent(): ?string
    {
        return $this->story_content;
    }

    public function setStoryContent(string $story_content): static
    {
        $this->story_content = $story_content;

        return $this;
    }

    /**
     * @return Collection<int, Chapter>
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function addChapter(Chapter $chapter): static
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters->add($chapter);
            $chapter->setStory($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): static
    {
        if ($this->chapters->removeElement($chapter)) {
            // set the owning side to null (unless already changed)
            if ($chapter->getStory() === $this) {
                $chapter->setStory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->addStory($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            $article->removeStory($this);
        }

        return $this;
    }

   

    public function __toString()
    {
        return $this->story_title;
        
    }

    /**
     * @return Collection<int, Library>
     */
    public function getLibraries(): Collection
    {
        return $this->libraries;
    }

    public function addLibrary(Library $library): static
    {
        if (!$this->libraries->contains($library)) {
            $this->libraries->add($library);
            $library->addLibRead($this);
        }

        return $this;
    }

    public function removeLibrary(Library $library): static
    {
        if ($this->libraries->removeElement($library)) {
            $library->removeLibRead($this);
        }

        return $this;
    }


}