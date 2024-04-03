<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;

class GuideController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/guide', name: 'guide_index')]
    public function index(): Response
    {
        $categories = $this->entityManager->getRepository(Categorie::class)->findAll();

        $article = $this->entityManager->getRepository(Article::class)->findAll();

        return $this->render('guide/index.html.twig', [
            'categories' => $categories,
            'article' => $article,
        ]);
    }

    #[Route('/guide/{article}', name: 'detail_guide')]
    public function getArticle(Article $article): Response

    {
        
        $categories = $this->entityManager->getRepository(Categorie::class)->findAll();

        return $this->render('guide/view.html.twig', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }

    #[Route('/telecharger-pdf', name: 'telecharger_pdf')]
    public function telechargerPdf(Request $request): Response
    {
        // Récupérer le contenu HTML envoyé depuis le client
        $contenuHtml = json_decode($request->getContent(), true)['contenuHtml'];

        // Génération du PDF avec Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($contenuHtml);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Renvoyer le PDF en réponse
        $response = new Response($dompdf->output());
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="contenu.pdf"');

        return $response;
    }

}