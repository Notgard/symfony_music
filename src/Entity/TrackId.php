<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrackId
 *
 * @ORM\Table(name="track_id", indexes={@ORM\Index(name="song", columns={"song"}), @ORM\Index(name="album", columns={"album"}), @ORM\Index(name="number", columns={"number"})})
 * @ORM\Entity
 */
class TrackId
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
     * @var int
     *
     * @ORM\Column(name="album", type="integer", nullable=false, options={"comment"="Clé étrangère Album"})
     */
    private $album = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="song", type="integer", nullable=false, options={"comment"="Clé étrangère Morceau"})
     */
    private $song = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="diskNumber", type="integer", nullable=false, options={"comment"="Numéro du disque"})
     */
    private $disknumber = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false, options={"comment"="Numéro de piste"})
     */
    private $number = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="duration", type="integer", nullable=true, options={"comment"="Durée en secondes"})
     */
    private $duration = '0';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlbum(): ?int
    {
        return $this->album;
    }

    public function setAlbum(int $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getSong(): ?int
    {
        return $this->song;
    }

    public function setSong(int $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getDisknumber(): ?int
    {
        return $this->disknumber;
    }

    public function setDisknumber(int $disknumber): self
    {
        $this->disknumber = $disknumber;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
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


}
