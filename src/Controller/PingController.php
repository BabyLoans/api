<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PingController extends AbstractController
{
    #[Route('/ping', name: 'ping')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'pong!',
        ]);
    }
}
