<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post as MetaPost;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Serializer\Filter\PropertyFilter;
use App\Repository\FriendRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: FriendRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new Delete(),
    new GetCollection(),
    new MetaPost(),
])]
class Friend
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'firstUserFriends')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $firstUser = null;

    #[ORM\ManyToOne(inversedBy: 'secondUserFriends')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $secondUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstUser(): ?User
    {
        return $this->firstUser;
    }

    public function setFirstUser(?User $firstUser): self
    {
        $this->firstUser = $firstUser;

        return $this;
    }

    public function getSecondUser(): ?User
    {
        return $this->secondUser;
    }

    public function setSecondUser(?User $secondUser): self
    {
        $this->secondUser = $secondUser;

        return $this;
    }
}
