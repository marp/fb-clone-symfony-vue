<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Serializer\Filter\PropertyFilter;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['uuid'], message: 'There is already an account with this uuid')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
//#[ApiFilter(PropertyFilter::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $uuid = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     *
    */
    #[ORM\Column]
    #[Groups(['write'])]
    private ?string $password = null;

    #[ORM\Column(length: 1000, unique: false)]
    #[Groups(['owner:read', 'write'])]
    private ?string $email = null;

    #[ORM\Column(length: 1000)]
    #[Groups(['read', 'write'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 1000)]
    #[Groups(['read', 'write',])]
    private ?string $lastName = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Post::class, orphanRemoval: true)]
    #[Groups(['read'])]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: FriendRequest::class, orphanRemoval: true)]
    private Collection $senderFriendRequests;

    #[ORM\OneToMany(mappedBy: 'receiver', targetEntity: FriendRequest::class, orphanRemoval: true)]
    private Collection $receiverFriendRequests;

    #[ORM\OneToMany(mappedBy: 'firstUser', targetEntity: Friend::class, orphanRemoval: true)]
    private Collection $firstUserFriends;

    #[ORM\OneToMany(mappedBy: 'secondUser', targetEntity: Friend::class, orphanRemoval: true)]
    private Collection $secondUserFriends;

/*    #[ORM\OneToMany(mappedBy: 'firstUser', targetEntity: Friend::class, orphanRemoval: true)]
    private Collection $firstUserFriends;

    #[ORM\OneToMany(mappedBy: 'secondUser', targetEntity: Friend::class, orphanRemoval: true)]
    private Collection $secondUserFriend;*/



    /*
     * Many Users have Many Users.
     * @ManyToMany(targetEntity="User", mappedBy="myFriends")

    */
//    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'myFriends')]
//    private $friendsWithMe;

    /*
     * Many Users have many Users.
     * @ORM\ManyToMany(targetEntity="User", inversedBy="friendsWithMe")
     * @ORM\JoinTable(name="friends",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
     *      )
     */
//    private $myFriends;
//    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'friendsWithMe')]
//    #[ORM\JoinTable(name: 'friends',
//        joinColumns: [ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')],
//        inverseJoinColumns: []
//    )]
//    private $myFriends;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->senderFriendRequests = new ArrayCollection();
        $this->receiverFriendRequests = new ArrayCollection();

//        $this->firstUserFriends = new ArrayCollection();
//        $this->secondUserFriend = new ArrayCollection();
$this->secondUserFriends = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->uuid;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthor($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getAuthor() === $this) {
                $post->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FriendRequest>
     */
    public function getSenderFriendRequests(): Collection
    {
        return $this->senderFriendRequests;
    }

    public function addSenderFriendRequest(FriendRequest $senderFriendRequest): self
    {
        if (!$this->senderFriendRequests->contains($senderFriendRequest)) {
            $this->senderFriendRequests->add($senderFriendRequest);
            $senderFriendRequest->setSender($this);
        }

        return $this;
    }

    public function removeSenderFriendRequest(FriendRequest $senderFriendRequest): self
    {
        if ($this->senderFriendRequests->removeElement($senderFriendRequest)) {
            // set the owning side to null (unless already changed)
            if ($senderFriendRequest->getSender() === $this) {
                $senderFriendRequest->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FriendRequest>
     */
    public function getReceiverFriendRequests(): Collection
    {
        return $this->receiverFriendRequests;
    }

    public function addReceiverFriendRequest(FriendRequest $receiverFriendRequest): self
    {
        if (!$this->receiverFriendRequests->contains($receiverFriendRequest)) {
            $this->receiverFriendRequests->add($receiverFriendRequest);
            $receiverFriendRequest->setReceiver($this);
        }

        return $this;
    }

    public function removeReceiverFriendRequest(FriendRequest $receiverFriendRequest): self
    {
        if ($this->receiverFriendRequests->removeElement($receiverFriendRequest)) {
            // set the owning side to null (unless already changed)
            if ($receiverFriendRequest->getReceiver() === $this) {
                $receiverFriendRequest->setReceiver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Friend>
     */
    public function getFirstUserFriends(): Collection
    {
        return $this->firstUserFriends;
    }

    public function addFirstUserFriend(Friend $firstUserFriend): self
    {
        if (!$this->firstUserFriends->contains($firstUserFriend)) {
            $this->firstUserFriends->add($firstUserFriend);
            $firstUserFriend->setFirstUser($this);
        }

        return $this;
    }

    public function removeFirstUserFriend(Friend $firstUserFriend): self
    {
        if ($this->firstUserFriends->removeElement($firstUserFriend)) {
            // set the owning side to null (unless already changed)
            if ($firstUserFriend->getFirstUser() === $this) {
                $firstUserFriend->setFirstUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Friend>
     */
    public function getSecondUserFriends(): Collection
    {
        return $this->secondUserFriends;
    }

    public function addSecondUserFriend(Friend $secondUserFriend): self
    {
        if (!$this->secondUserFriends->contains($secondUserFriend)) {
            $this->secondUserFriends->add($secondUserFriend);
            $secondUserFriend->setSecondUser($this);
        }

        return $this;
    }

    public function removeSecondUserFriend(Friend $secondUserFriend): self
    {
        if ($this->secondUserFriends->removeElement($secondUserFriend)) {
            // set the owning side to null (unless already changed)
            if ($secondUserFriend->getSecondUser() === $this) {
                $secondUserFriend->setSecondUser(null);
            }
        }

        return $this;
    }
}
