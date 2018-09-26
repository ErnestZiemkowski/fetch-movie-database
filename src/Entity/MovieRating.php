<?php

namespace App\Entity;

use App\Entity\Movie;
use App\Entity\Rating;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRatingRepository")
 */
class MovieRating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $value;

    /**
     * Many MovieRating have One Movie
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="movieRatings")
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     */
    private $movie;

    /**
     * Many MovieRatings have One Rating
     * @ORM\ManyToOne(targetEntity="Rating", inversedBy="movieRatings")
     * @ORM\JoinColumn(name="rating_id", referencedColumnName="id")
     */
    private $rating;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    public function setRating(Rating $rating)
    {
        $this->rating = $rating;

        return $this;
    }
}
