<?php

namespace App\Controller;
use App\Entity\User;
use App\Repository\FicheRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class SiteController extends AbstractController
{
    #[Route('/', name: 'HomePage')]
    public function index(): Response
    {
        return $this->render('site/index.html.twig');
    }
    #[Route('/enregistrement', name: 'EnregistrementSucces')]
    public function succes(): Response
    {
        return $this->render('site/EnregistrementSucces.html.twig');
    }
    #[Route('/demandeEffectué', name: 'demandeSucces')]
    public function success(): Response
    {
       
       
        return $this->render('site/Succes.html.twig');
    }

 
}
