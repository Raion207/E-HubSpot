<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 50)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 100)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updateAt = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $user = null;

    #[ORM\OneToMany(mappedBy: 'articles', targetEntity: comments::class, orphanRemoval: true)]
    private Collection $comment;

    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'articles')]
    private Collection $category;

    #[ORM\ManyToMany(targetEntity: Keywords::class, inversedBy: 'articles')]
    private Collection $keyword;

    public function __construct()
    {
        $this->comment = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->keyword = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUser(): ?users
    {
        return $this->user;
    }

    public function setUser(?users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, comments>
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(comments $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment->add($comment);
            $comment->setArticles($this);
        }

        return $this;
    }

    public function removeComment(comments $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticles() === $this) {
                $comment->setArticles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Keywords>
     */
    public function getKeyword(): Collection
    {
        return $this->keyword;
    }

    public function addKeyword(Keywords $keyword): self
    {
        if (!$this->keyword->contains($keyword)) {
            $this->keyword->add($keyword);
        }

        return $this;
    }

    public function removeKeyword(Keywords $keyword): self
    {
        $this->keyword->removeElement($keyword);

        return $this;
    }

}
