<?php
namespace App\EventListener;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class PostListener{

    private Security $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Post $post, LifecycleEventArgs $event): void
    {
        if(empty($this->security->getUser())) dump('User is not logged in!');
        $post->setAuthor($this->security->getUser());
    }
}