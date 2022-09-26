<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ImageFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ImageFinder $imageFinder): Response
    {
        $image = $imageFinder->getAssetUrl('images/wally-1.png');
        dump($image);

        return $this->render('pages/home.html.twig');
    }
}
