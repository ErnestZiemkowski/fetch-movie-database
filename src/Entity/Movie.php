<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
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
    private $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $rated;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $released;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $runtime;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $plot;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $awards;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $poster_url;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $metascore;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $imdbRating;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $imdbVotes;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $imdbId;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dvd;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $boxOffice;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $production;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $website_url;

    /**
     * Many Movies have Many Genres
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="movies")
     * @ORM\JoinTable(name="movies_genres")
     */
    private $genres;

    /**
     * Many Movies have Many Directors
     * @ORM\ManyToMany(targetEntity="Director", inversedBy="movies")
     * @ORM\JoinTable(name="movies_directors")
     */
    private $directors;

    /**
     * Many Movies have Many Writer
     * @ORM\ManyToMany(targetEntity="Writer", inversedBy="movies")
     * @ORM\JoinTable(name="movies_writers")
     */
    private $writers;

    /**
     * Many Movies have Many Languages
     * @ORM\ManyToMany(targetEntity="Language", inversedBy="movies")
     * @ORM\JoinTable(name="movies_languages")
     */
    private $languages;

    /**
     * Many Movies have Many Countries
     * @ORM\ManyToMany(targetEntity="Country", inversedBy="movies")
     * @ORM\JoinTable(name="movies_countries")
     */
    private $countries;

    public function __construct() {
        $this->genres = new ArrayCollection();
        $this->directors = new ArrayCollection();
        $this->writers = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->countries = new ArrayCollection();
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

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(?\DateTimeInterface $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getRated(): ?string
    {
        return $this->rated;
    }

    public function setRated(?string $rated): self
    {
        $this->rated = $rated;

        return $this;
    }

    public function getReleased(): ?\DateTimeInterface
    {
        return $this->released;
    }

    public function setReleased(?\DateTimeInterface $released): self
    {
        $this->released = $released;

        return $this;
    }

    public function getRuntime(): ?string
    {
        return $this->runtime;
    }

    public function setRuntime(?string $runtime): self
    {
        $this->runtime = $runtime;

        return $this;
    }

    public function getPlot(): ?string
    {
        return $this->plot;
    }

    public function setPlot(?string $plot): self
    {
        $this->plot = $plot;

        return $this;
    }

    public function getAwards(): ?string
    {
        return $this->awards;
    }

    public function setAwards(?string $awards): self
    {
        $this->awards = $awards;

        return $this;
    }

    public function getPosterUrl(): ?string
    {
        return $this->poster_url;
    }

    public function setPosterUrl(?string $poster_url): self
    {
        $this->poster_url = $poster_url;

        return $this;
    }

    public function getMetascore(): ?int
    {
        return $this->metascore;
    }

    public function setMetascore(?int $metascore): self
    {
        $this->metascore = $metascore;

        return $this;
    }

    public function getImdbRating(): ?float
    {
        return $this->imdbRating;
    }

    public function setImdbRating(?float $imdbRating): self
    {
        $this->imdbRating = $imdbRating;

        return $this;
    }

    public function getImdbVotes(): ?int
    {
        return $this->imdbVotes;
    }

    public function setImdbVotes(?int $imdbVotes): self
    {
        $this->imdbVotes = $imdbVotes;

        return $this;
    }

    public function getImdbId(): ?string
    {
        return $this->imdbId;
    }

    public function setImdbId(?string $imdbId): self
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDvd(): ?\DateTimeInterface
    {
        return $this->dvd;
    }

    public function setDvd(?\DateTimeInterface $dvd): self
    {
        $this->dvd = $dvd;

        return $this;
    }

    public function getBoxOffice(): ?string
    {
        return $this->boxOffice;
    }

    public function setBoxOffice(?string $boxOffice): self
    {
        $this->boxOffice = $boxOffice;

        return $this;
    }

    public function getProduction(): ?string
    {
        return $this->production;
    }

    public function setProduction(?string $production): self
    {
        $this->production = $production;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->website_url;
    }

    public function setWebsiteUrl(?string $website_url): self
    {
        $this->website_url = $website_url;

        return $this;
    }
}
