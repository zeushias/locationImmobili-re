<?php

namespace App\Controller;
    
use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TypeLogementRepository;

class ConnexionController extends AbstractController
{
    // déclarations
    private $message ;
    private $utilisateurRepository;

    // contructeur
    public function __construct(UtilisateursRepository $utilisateurRepository, TypeLogementRepository $typeLogementRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
        $this->typeLogementRepository = $typeLogementRepository;
        $this->message = '';
    }

    #[Route('/connexion', name: 'connexion_page')]
    public function index(): Response
    {
        return $this->render('connexion/connexion.html.twig', ['controller_name' => '', 'message' => '',]);
    }

    // connexion
    /**
    *@Route("/connexion/authentification", methods={"POST"})
    */
    public function connect(Request $request)
    {
        $typelogements = $this->typeLogementRepository->findAll();

        if($request->isMethod('POST')){
            $data = $request->request->all();

            $user = $this->utilisateurRepository->findByLoginAndPass($data['login'], $data['pass']); 

            if($user != null){

                $session = $request->getSession();
                $session->start();
                $session->set('session_user', $user);
                
            return $this->render('pins/indexUser.html.twig', ['typelogements' => $typelogements,'userConnect' => $user, 'message' => '', ]);
            }
        } 

        return $this->render('pins/indexUser.html.twig', ['typelogements' => $typelogements,'userConnect' => '', 'message' => "Cet utilisateur n'existe pas ", ]);
    }

    /** deconnexion
    *@Route("/deconnexion")
    */
    public function deconnect(Request $request)
    {
        $typelogements = $this->typeLogementRepository->findAll();
        $request->getSession()->invalidate();
                
                return $this->render('pins/index.html.twig', [
            'userConnect' => '', 'typelogements' => $typelogements,
        ]);
            
    }
    
}
