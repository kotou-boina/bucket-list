<?php

namespace App\Entity;

use App\Repository\IdeaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: IdeaRepository::class)]
class Idea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    /**
     * @var string
     */
    #[ORM\Column(type: "string", length: 250)]
    #[Assert\NotBlank(message: 'Précisez le titre')]
    #[Assert\Length(max: 250, maxMessage: 'Le titre est trop long, taille max: 250')]
    private $title;

    /**
     * @var string
     */
    #[ORM\Column(type: "text")]
    private $description;

    /**
     * @var string
     */
    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank(message: 'Précisez l\'auteur')]
    #[Assert\Length(max: 50, maxMessage: 'Le titre est trop long, taille max: 250')]
    private $author;

    /**
     * @var boolean
     */
    #[ORM\Column(type: "boolean")]
    private $isPublished;

    /**
     * @var \DateTime
     */
    #[ORM\Column(type: "datetime")]
    private $dateCreated;

    #[ORM\ManyToOne(inversedBy: 'ideas')]
    private ?Category $category = null;

    /* *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    /**
     * @param bool $isPublished
     */
    public function setIsPublished(bool $isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
