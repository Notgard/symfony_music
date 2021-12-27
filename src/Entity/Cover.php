<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cover
 *
 * @ORM\Table(name="cover")
 * @ORM\Entity
 */
class Cover
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
     * @ORM\Column(name="jpeg", type="blob", length=16777215, nullable=false, options={"comment"="Données JPEG"})
     */
    private $jpeg;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJpeg()
    {
        return $this->jpeg;
    }

    public function setJpeg($jpeg): self
    {
        $this->jpeg = $jpeg;

        return $this;
    }


}
