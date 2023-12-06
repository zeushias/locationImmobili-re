<?php

namespace App\Controller;


use App\Entity\TypeLogement;
use App\Entity\Annonces;
use App\Entity\Logements;

use App\Repository\TypeLogementRepository;
use App\Repository\LogementsRepository;
use App\Repository\AnnoncesRepository;
use App\Repository\UtilisateurController;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PinsController extends AbstractController
{

    // déclarations
    private $typeLogementRepository;
    private $annoncesRepository;
    private $logementRepository;
    private $message;
    
    // contructeur
    public function __construct(TypeLogementRepository $typeLogementRepository, LogementsRepository $logementRepository, AnnoncesRepository $annoncesRepository)
    {
        $this->typeLogementRepository = $typeLogementRepository;
        $this->annoncesRepository = $annoncesRepository;
        $this->logementRepository = $logementRepository;
        $this->message = '';
    }

    /** affichage page acceuil non utilisateur
     * @Route("/", name="app_pins")
     */
    public function index(): Response
    {
        $typelogements = $this->typeLogementRepository->findAll();

        return $this->render('pins/index.html.twig', [
            'typelogements' => $typelogements,
        ]);
    }

    /** click sur le bouton de recherche
     * @Route("/", name="app_pins")
     */
    public function rechercher(): Response
    {
        $typelogements = $this->typeLogementRepository->findAll();

        return $this->render('pins/index.html.twig', [
            'typelogements' => $typelogements,
        ]);
    }


    /** affichage page acceuil utilisateur
     * @Route("/home", name="app_pins_user")
     */
    public function indexUser(): Response
    {
        $typelogements = $this->typeLogementRepository->findAll();

        return $this->render('pins/indexUser.html.twig', [
            'typelogements' => $typelogements,
        ]);
    }

    
}
