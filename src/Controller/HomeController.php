<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ImageFinder;
use App\Service\ImageSplitter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ImageFinder $imageFinder, ImageSplitter $imageSplitter): Response
    {
        $image_path = $imageFinder->getAssetUrl('images/captcha/wally-1.png');

        $images = $imageSplitter->getSplittedImages($image_path);

        if (empty($images)) {
            $imageSplitter->split($image_path);
            $images = $imageSplitter->getSplittedImages($image_path);
        }

        return $this->render('pages/home.html.twig', [
            'images' => $images,
        ]);
    }
}
