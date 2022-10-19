<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    #[Route('/test')]
    #[Route('/friends')]
    #[Route('/friend_requests')]
    #[Route('/search')]
    #[Route('/@{id<\d+>}')]
    #[Route('/login')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    #[Route('/dev')]
    public function dev(PostRepository $postRepository):Response
    {
        dd($postRepository->findAll());
//        dd($postRepository->find(1));
        return new JsonResponse(0);
    }
}
