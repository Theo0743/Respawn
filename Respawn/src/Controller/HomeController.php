<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')] // La route "/" signifie que c'est ta page d'accueil
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // On demande à Symfony d'afficher le template du forum Gaming
        // Assure-toi que le fichier existe dans templates/accueil/index.html.twig 
        // ou adapte le chemin ci-dessous :
        return $this->render('accueil/index.html.twig');
    }
}