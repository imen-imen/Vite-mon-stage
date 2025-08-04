<?php

namespace App\Entity;

use App\Repository\CandidacyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidacyRepository::class)]
class Candidacy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $message = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateCandidacy = null;

    #[ORM\ManyToOne(inversedBy: 'candidacies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offer $offerId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getDateCandidacy(): ?\DateTimeImmutable
    {
        return $this->dateCandidacy;
    }

    public function setDateCandidacy(\DateTimeImmutable $dateCandidacy): static
    {
        $this->dateCandidacy = $dateCandidacy;

        return $this;
    }

    public function getUserceId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?
    user $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getOfferId(): ?Offer
    {
        return $this->offerId;
    }

    public function setOfferId(?Offer $offerId): static
    {
        $this->offerId = $offerId;

        return $this;
    }
}
