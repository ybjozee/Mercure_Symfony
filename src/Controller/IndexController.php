<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController {

    #[Route('/', name: 'app_index')]
    public function index()
    : Response {

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/publish', name: 'publish')]
    public function publish(HubInterface $hub)
    : JsonResponse {

        $update = new Update(
            '/test',
            json_encode(['update' => 'New update received at '.date("h:i:sa")])
        );

        $hub->publish($update);

        return $this->json(['message' => 'Update published']);
    }
}
