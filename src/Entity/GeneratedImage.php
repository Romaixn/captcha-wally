<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\GeneratedImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneratedImageRepository::class)]
class GeneratedImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $isValid = null;

    #[ORM\ManyToOne(inversedBy: 'generatedImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Captcha $captcha = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    public function getCaptcha(): ?Captcha
    {
        return $this->captcha;
    }

    public function setCaptcha(?Captcha $captcha): self
    {
        $this->captcha = $captcha;

        return $this;
    }
}
