<?php

namespace App\Controller;

use App\Entity\AgentVisite;
use App\Entity\RapportEmpotage;
use doctrine;
use App\Entity\User;
use App\Entity\Fiche;
use App\Form\FicheType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route('/cda')]
class DemandeEmpotageController extends AbstractController
{
    #[Route('/demandeEmpotage', name: 'demandeEmpotage')]
    public function index(Request $request, 
    EntityManagerInterface $manager,
     UserRepository $repository): Response
    {
        $fiche = new Fiche();
        $rapport = new RapportEmpotage;
        $agent = $repository->findOneByNombreDossier();
        $agentNbre = $agent->getNombreDossier();
        $NbreDossier =   $agentNbre+1;
        $nomAgent = $agent->getNom();
        $prenomAgent = $agent->getPrenom();
        $contactAgent = $agent->getContact();
        $NbreDossier = strval($NbreDossier);
        $form = $this->createForm(FicheType::class, $fiche);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fiche = $form->getData();
            $fiche->setUser($agent);
            $fiche->setStatut(false);
            $agent->setNombreDossier($NbreDossier);
            $manager->persist($fiche);
            $rapport->setFiche($fiche);
            $rapport->setUser($agent);
            $manager->persist($rapport);
            $manager->flush();
        
    }
    return $this->render('demande_empotage/index.html.twig',[
        'form' => $form->createView(),
    ]);
}
}
