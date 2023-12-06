<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UtilisateurController extends AbstractController
{
    // déclarations
    private $message ;
    private $utilisateurRepository;

    // contructeur
    public function __construct(UtilisateursRepository $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
        $this->message = '';

    }

    // afficher page de d'enrégistrement d'un utilisateur
    #[Route('/utilisateur/add', name: 'app_utilisateur')]
    public function create(): Response
    {
        return $this->render('utilisateur/utilisateur.html.twig', [
            'user' => '', 'message' =>'',
        ]);
    }

    // afficher page de modification d'un utilisateur
    #[Route('/utilisateur/add/{id}', name: 'app_utilisateur_mod')]
    public function modify(): Response
    {
        $user = $this->utilisateurRepository->findById((int) $id);

        return $this->render('utilisateur/utilisateur.html.twig', [
            'user' => $user, 'message' =>'',
        ]);
    }

    // afficher page de modification d'un utilisateur
    #[Route('/utilisateur/remove/{id}', name: 'app_utilisateur_mod')]
    public function remove($id): Response
    {
        $user = $this->utilisateurRepository->findById($id);
        
        //$user = $this->utilisateurRepository->($id);

        return $this->render('utilisateur/utilisateur.html.twig', [
            'user' => $user, 'message' =>'',
        ]);
    }

    // affichage liste de tous les utilisateurs
    #[Route('/utilisateur/', name: 'user_list_page')]
    public function getAll(): Response
    {
        $utilisateurs = $this->utilisateurRepository->getAllValide();
        //dd($utilisateurs);
        $data = [];

        foreach ($utilisateurs as $utilisateur) {
            $data[] = [
                'id' => $utilisateur->getId(),
                'login' => $utilisateur->getLogin(),
                'pass' => $utilisateur->getPass(),
                'nomComplet' => $utilisateur->getNomComplet(),
                'email' => $utilisateur->getEmail(),
            ];
        }

        return $this->render('utilisateur/utilisateurList.html.twig', [
            'utilisateurs' => $data,
        ]);
        
    }

    // 
    /**
    *@Route("/utilisateur/create", methods={"POST"})
    */
    public function add(Request $request)
    {
        $utilisateur = new Utilisateurs;

        if($request->isMethod('POST')){
            $data = $request->request->all();

            // utilisateur
            if($data['id'] != "" and $data['id'] != null){
                $utilisateur-> setId($data['id']); 
            }
            $utilisateur-> setLogin($data['login']);   
            $utilisateur-> setPass($data['pass']);   
            $utilisateur-> setNomComplet($data['nomComplet']);   
            $utilisateur-> setEmail($data['email']); 
            $utilisateur-> setStatut("V");  
            
            //contrôle 
            $this->controle($data);

            if($this->message === ""){  

            $this->utilisateurRepository->add($utilisateur, true);

            $this->message = 'Enrégistrement effectué avec succès';

            return $this->render('utilisateur/utilisateur.html.twig', [
            'user' => '', 'message' => $this->message,]);
            }
        }
        return $this->render('utilisateur/utilisateur.html.twig', [
            'user' => $utilisateur, 'message' => $this->message,]);

        }
    

    // contrôle des saisies
    public function controle($data) {

        if($data['login'] === null or $data['login'] === ""){
                $this->message = 'Veuillez saisir le login';
        }

        if($data['pass'] === null or $data['pass'] === ""){
                $this->message = 'Veuillez saisir le mot de passe';
        }

        if($data['nomComplet'] === null or $data['nomComplet'] === ""){
                $this->message = 'Veuillez saisir le nom & prénoms';
        }

        if($data['email'] === null or $data['email'] === ""){
                $this->message = "Veuillez saisir l'email";
        }


        $userExistant = $this->utilisateurRepository->findByLogin($data['login']); 

        if($userExistant != null){      

            $this->message = 'Ce login existe déjà! Merci';

        } 
    }
    
}
