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
        $image_path = $imageFinder->getImageUrl('wally-1.png');

        $images = $imageSplitter->getSplittedImages($image_path);

        // TODO : Find a way to trigger the refresh when cols/rows params in split function change | here we need to delete the splitted folder or use the SplitImageCommand which is not accurate
        if (empty($images)) {
            $imageSplitter->split($image_path);
            $images = $imageSplitter->getSplittedImages($image_path);
        }

        return $this->render('pages/home.html.twig', [
            'images' => $images,
        ]);
    }
}
