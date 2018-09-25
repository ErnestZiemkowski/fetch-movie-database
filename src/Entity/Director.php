<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DirectorRepository")
 */
class Director
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
    private $director;

    /**
     * Many Directors have Many Movies
     * @ORM\ManyToMany(targetEntity="Movie", mappedBy="director")
     */
    private $movie;

    public function __construct() {
        $this->movie = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function setMovie(Movie $movie)
    {
        $this->movie[] = $movie;

        return $this;
    }
}
