<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClasseCOntrollerController extends AbstractController
{
    #[Route('/classe', name: 'classe')]
    public function index(): Response
    {
        return $this->render('classe/index.html.twig');
    }
}
