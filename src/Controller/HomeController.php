<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $latestArticle = $this->entityManager->getRepository(Article::class)->findOneBy(['isPrive' => false], ['createdAt' => 'DESC']);
    
        return $this->render('home/index.html.twig', [
            'latestArticle' => $latestArticle,
        ]);
    }
    
}