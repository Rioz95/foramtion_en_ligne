<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminSideBarController extends AbstractController
{
    #[Route('/admin', name: 'admin_sidebar')]
    public function index(): Response
    {
        return $this->render('admin/sidebar.html.twig');
    }
}
