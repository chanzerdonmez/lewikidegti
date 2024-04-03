<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{

    #[Route('/upload', name: 'upload')]
    public function uploadImagePost(Request $request): JsonResponse
    {
        $file = $request->files->get('image');

        if (!$file instanceof UploadedFile) {
            return new JsonResponse(['error' => 'No file uploaded.'], 400);
        }

        $imageFolder = "assets/images/";

        $newFileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($imageFolder, $newFileName);

        $baseUrl = $request->getSchemeAndHttpHost() . $request->getBasePath() . '/';

        return new JsonResponse(['location' => $baseUrl . $imageFolder . $newFileName]);
    }

}
