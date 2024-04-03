<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/search', name: 'app_search')]
    public function search(Request $request): Response
    {
        $keyword = $request->query->get('q');

        // Récupérer les articles contenant le mot-clé dans le titre
        $articles = $this->entityManager->getRepository(Article::class)->findByKeywordInTitle($keyword);

        return $this->render('search/index.html.twig', [
            'articles' => $articles,
            'keyword' => $keyword,
        ]);
    }
}

