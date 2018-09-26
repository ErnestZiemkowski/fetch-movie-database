<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WriterRepository")
 */
class Writer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $writer;

    /**
     * Many Writers have Many Movies
     * @ORM\ManyToMany(targetEntity="Movie", mappedBy="writers")
     */
    private $movies;

    public function __construct() {
        $this->movie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWriter(): ?string
    {
        return $this->writer;
    }

    public function setWriter(string $writer): self
    {
        $this->writer = $writer;

        return $this;
    }

    public function setMovie(Movie $movie)
    {
        $this->movies[] = $movie;

        return $this;
    }

}
