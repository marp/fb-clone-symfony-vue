<?php

namespace App\EventListener;

use App\Entity\FriendRequest;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\FriendRequestRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class FriendRequestListener
{
    private Security $security;
    private FriendRequestRepository $friendRequestRepository;

    public function __construct(Security $security, FriendRequestRepository $friendRequestRepository)
    {
        $this->security = $security;
        $this->friendRequestRepository = $friendRequestRepository;
    }

    public function prePersist(FriendRequest $friendRequest, LifecycleEventArgs $event): void
    {
        if (empty($this->security->getUser())) dump('User is not logged in!');
        $friendRequest->setSender($this->security->getUser());

        if ($friendRequest->getSender() === $friendRequest->getReceiver()) {
            dump('Sender cannot be the same as Receiver');
            $friendRequest->setSender(null);
            $friendRequest->setReceiver(null);
        }

        if (
            $this->friendRequestRepository->findOneBy([
                'sender' => $friendRequest->getSender(),
                'receiver' => $friendRequest->getReceiver()
            ])
            ||
            $this->friendRequestRepository->findOneBy([
                'receiver' => $friendRequest->getSender(),
                'sender' => $friendRequest->getReceiver()
            ])
        ) {
            dump('That friend request already exists.');
            $friendRequest->setSender(null);
            $friendRequest->setReceiver(null);
        };
    }
}