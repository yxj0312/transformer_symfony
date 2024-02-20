<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{    
    public function index()
    {
        dd(u('hello')->camel()->title());
    }
}
