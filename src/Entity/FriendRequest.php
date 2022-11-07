<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FriendRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FriendRequestRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection(),
    new Post(security: "is_granted('ROLE_USER')"),
    new Delete(security: "is_granted('ROLE_USER') and (object.getSender() == user or object.getReceiver() == user)")
],  normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']]
)]
class FriendRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['read'])]
    private ?\DateTimeInterface $dateTime = null;

    #[ORM\ManyToOne(inversedBy: 'senderFriendRequests')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read'])]
    private ?User $sender = null;

    #[ORM\ManyToOne(inversedBy: 'receiverFriendRequests')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read', 'write'])]
    private ?User $receiver = null;

    public function __construct()
    {
        $this->dateTime = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?User
    {
        return $this->receiver;
    }

    public function setReceiver(?User $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }
}
