<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CaptchaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaptchaRepository::class)]
class Captcha
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $baseImage = null;

    #[ORM\OneToMany(mappedBy: 'captcha', targetEntity: GeneratedImage::class, orphanRemoval: true)]
    private Collection $generatedImages;

    public function __construct()
    {
        $this->generatedImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBaseImage(): ?string
    {
        return $this->baseImage;
    }

    public function setBaseImage(string $baseImage): self
    {
        $this->baseImage = $baseImage;

        return $this;
    }

    public function getGeneratedImages(): Collection
    {
        return $this->generatedImages;
    }

    public function addGeneratedImage(GeneratedImage $generatedImage): self
    {
        $this->generatedImages->add($generatedImage);
        $generatedImage->setCaptcha($this);

        return $this;
    }

    public function removeGeneratedImage(GeneratedImage $generatedImage): self
    {
        // set the owning side to null (unless already changed)
        if ($this->generatedImages->removeElement($generatedImage) && $generatedImage->getCaptcha() === $this) {
            $generatedImage->setCaptcha(null);
        }

        return $this;
    }
}
