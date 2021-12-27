<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Track
 *
 * @ORM\Table(name="track", indexes={@ORM\Index(name="album", columns={"album"}), @ORM\Index(name="number", columns={"number"}), @ORM\Index(name="song", columns={"song"})})
 * @ORM\Entity
 */
class Track
{
    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false, options={"comment"="Numéro de piste"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $number = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="disknumber", type="integer", nullable=false, options={"comment"="Numéro du disque"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $disknumber = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="duration", type="integer", nullable=true, options={"comment"="Durée en secondes"})
     */
    private $duration = '0';

    /**
     * @var Song
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Song")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="song", referencedColumnName="id")
     * })
     */
    private $song;

    /**
     * @var Album
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="tracks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="album", referencedColumnName="id")
     * })
     */
    private $album;

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function getDisknumber(): ?int
    {
        return $this->disknumber;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getSong(): ?Song
    {
        return $this->song;
    }

    public function setSong(?Song $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }


}
