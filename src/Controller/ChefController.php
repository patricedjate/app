<?php

namespace App\Controller;

use App\Entity\AgentVisite;
use App\Repository\UserRepository;
use App\Repository\FicheRepository;
use App\Repository\AgentVisiteRepository;
use App\Repository\RapportEmpotageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

#[Route('/chef')]
class ChefController extends AbstractController
{
    #[isGranted('ROLE_CHEF')]
    #[Security("is_granted('ROLE_CHEF')")]
    #[Route('/', name: 'chef_Index')]
    public function index(RapportEmpotageRepository $rapport, UserRepository $agent, FicheRepository $ficherepo): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        $nombre = count($rapport->findNbre());
        $nombreAgent = count($agent->findNbre());
        $nombreFiche = count($ficherepo->findNbre());
        $NonEffectue = count($rapport->findNbreNon()) - $nombre;
        $fiches = $ficherepo->countByDate();
        $rapports = $rapport->countByDate();
        $dates = [];
        $ficheCount = [];
        foreach ($fiches as $fiche) {
            $dates[] = $fiche['nbrejour'];
            $ficheCount[] = $fiche['count'];
        }
        $rapports = $rapport->countByDate();
        $datess = [];
        $rapportCount = [];
        foreach ($rapports as $rapport) {
            $datess[] = $rapport['nbrejour'];
            $rapportCount[] = $rapport['count'];
        }
        return $this->render('chef/index.html.twig',[
            "nombre"=> $nombre,
            "nombreAgent"=>$nombreAgent,
            "nombreFiche"=>$nombreFiche,
            "nonEffectue"=> $NonEffectue,
            "date"=>json_encode($dates),
            'nbre'=>json_encode($ficheCount),
            "datess"=>json_encode($datess),
            'nbres'=>json_encode($rapportCount)
        ]);
    }
    #[isGranted('ROLE_CHEF')]
    #[Security("is_granted('ROLE_CHEF')")]
    #[Route('/ListeAgent', name: 'chef_ListeAgent')]
    public function agent(UserRepository $repository): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        $agents = $repository->findAllUserByRoles();
        return $this->render('chef/ListeAgent.html.twig',[
            'agents'=>$agents
        ]);
    }
    #[isGranted('ROLE_CHEF')]
    #[Security("is_granted('ROLE_CHEF')")]
    #[Route('/ListeFicheTraite/{id}', name: 'ListeFicheTraite')]
    public function traite(Request $request, FicheRepository $repository, UserRepository $userRepository): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        $fiches = $repository->findAllFicheEffectueByUser($request->attributes->get('id'));
        $username = $userRepository->findOneBy(["id"=>$request->attributes->get('id')])->getNom();
        return $this->render('chef/ListeFicheTraite.html.twig',[
            'fiches'=>$fiches,
            'username'=>$username
        ]);
    }
    #[isGranted('ROLE_CHEF')]
    #[Security("is_granted('ROLE_CHEF')")]
    #[Route('/ListeFicheNonTraite/{id}', name: 'ListeFicheNonTraite')]
    public function nonTraite(Request $request, FicheRepository $repository, UserRepository $userRepository): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        $fiches = $repository->findAllFicheByUser($request->attributes->get('id'));
        $username = $userRepository->findOneBy(["id"=>$request->attributes->get('id')])->getNom();
        return $this->render('chef/ListeFicheNonTraite.html.twig',[
            'fiches'=>$fiches,
            'username'=>$username
        ]);
    }
    #[isGranted('ROLE_CHEF')]
    #[Security("is_granted('ROLE_CHEF')")]
    #[Route("/rapport/{id}",name:"chef_rapport")]
    public function rapport(Request $request, RapportEmpotageRepository $repository):Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        $rapport = $repository->findBy(['id'=>$request->attributes->get('id')]);
        return $this->render('chef/rapport.html.twig',[
            'rapport'=>$rapport
        ]);
    }
}
