<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{    
    #[Route('/')]
    public function homepage(): Response
    {
       return $this->render('vinyl/homepage.html.twig'
       , [
              'title' => 'Vinyl Record Database',
              'genres' => ['Rock', 'Pop', 'Jazz', 'Classical', 'Other']
         ]
       );
    }

     #[Route('/browse/{slug}')]
    public function browse(string $slug = null): Response
    {
        if ($slug) {
            $title = 'Genre: '.u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = 'All Genres';
        }
        return new Response($title);
    }
}
