<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MicroPostRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MicroPostRepository::class)]
class MicroPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string',length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 5, max: 500, minMessage: 'The minimum chars required are {{ limit }}', maxMessage:'The maximum chars required are {{ limit }}')]
    private ?string $title = null;

    #[ORM\Column(type: 'string',length: 500)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 5, max: 500, minMessage: 'The minimum characters required are 5', maxMessage:'The maximum chars required are 500')]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $created = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(DateTimeInterface $created): static
    {
        $this->created = $created;

        return $this;
    }
}
