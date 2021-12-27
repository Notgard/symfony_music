<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Album.
 *
 * @ORM\Table(name="album", indexes={@ORM\Index(name="artist", columns={"artist"}), @ORM\Index(name="genre", columns={"genre"}), @ORM\Index(name="cover", columns={"cover"})})
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="Identifiant"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false, options={"default"="''","fixed"=true,"comment"="Titre"})
     */
    private $name = '\'\'';

    /**
     * @var int|null
     *
     * @ORM\Column(name="year", type="integer", nullable=true, options={"default"="NULL","comment"="Année de sortie"})
     */
    private $year = null;

    /**
     * @var Artist
     *
     * @ORM\ManyToOne (targetEntity="Artist", inversedBy="albums")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artist", referencedColumnName="id")
     * })
     */
    private $artist;

    /**
     * @var Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="genre", referencedColumnName="id")
     * })
     */
    private $genre;

    /**
     * @var Cover
     *
     * @ORM\ManyToOne(targetEntity="Cover")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cover", referencedColumnName="id")
     * })
     */
    private $cover;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Track", mappedBy="album", cascade={"remove"})
     * @ORM\OrderBy({"number" = "ASC"})
     */
    private $tracks;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): void
    {
        $this->artist = $artist;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): void
    {
        $this->genre = $genre;
    }

    public function getCover(): ?Cover
    {
        return $this->cover;
    }

    public function setCover(?Cover $cover): void
    {
        $this->cover = $cover;
    }

    /**
     * @return Collection|Track[]
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(Track $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->setAlbum($this);
        }

        return $this;
    }

    public function removeTrack(Track $track): self
    {
        if ($this->tracks->removeElement($track)) {
            // set the owning side to null (unless already changed)
            if ($track->getAlbum() === $this) {
                $track->setAlbum(null);
            }
        }

        return $this;
    }

    public function setTracks(?Track $tracks): self
    {
        // unset the owning side of the relation if necessary
        if (null === $tracks && null !== $this->tracks) {
            $this->tracks->setAlbum(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $tracks && $tracks->getAlbum() !== $this) {
            $tracks->setAlbum($this);
        }

        $this->tracks = $tracks;

        return $this;
    }
}
