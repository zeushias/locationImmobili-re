<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Annonces;
use App\Entity\Logements;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TypeLogementRepository;
use App\Repository\AnnoncesRepository;
use App\Repository\LogementsRepository;

class AnnoncesController extends AbstractController
{
    // déclarations
    private $message;
    private $typeLogementRepository;
    private $annoncesRepository;
    private $logementRepository;

   // contructeur 
    public function __construct(TypeLogementRepository $typeLogementRepository, LogementsRepository $logementRepository, AnnoncesRepository $annoncesRepository)
    {
        $this->typeLogementRepository = $typeLogementRepository;
        $this->annoncesRepository = $annoncesRepository;
        $this->logementRepository = $logementRepository;
        $this->message = '';
    }

    // liste des annonces
    #[Route('/annonce/list', name: 'app_annonces_all')]
    public function getAll(): Response
    {
        $annonces = $this->annoncesRepository->findAll();

        return $this->render('annonces/annonceList.html.twig', [
            'annonces' => $annonces, 'message' =>'',
        ]);
    }

    #[Route('/annonce', name: 'app_annonces')]
    public function index(): Response
    {
        $typelogements = $this->typeLogementRepository->findAll();

        return $this->render('annonces/annonce.html.twig', [
            'typelogements' => $typelogements, 'message' =>'',
        ]);
    }

    /**
    *@Route("/annonces/create", methods={"POST"})
    */
    public function create(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->request->all();
            
            //logement
            $logement = new Logements;          

            $typeLogExistant = $this->typeLogementRepository->findByLibelle($data['typeLogement']); 
             $logement->setTypeLogement($typeLogExistant);
            $logement->setDescription($data['description']);
            $logement->setNbPieces($data['nbPieces']);
            $logement->setNumeroEtage($data['numeroEtage']);
            $logement->setSuperficie($data['superficie']);
            $logement->setProprietaire($data['proprietaire']);
            $logement->setAdresseComplete($data['adresseComplete']);
            $logement->setCp($data['cp']);
            $logement->setVille($data['ville']);
            $logement->setPays($data['pays']);
            // annonce
            $annonce = new Annonces;
            $annonce-> setDateMiseEnLigne(new \DateTime());
            $annonce-> setDescription($data['descriptionA']);

            // contrôle 
            $this->controle($data);

            if($this->message === ""){
                $this->logementRepository->add($logement, true);
                $annonce-> setLienDossier('/public/images/logement/?');
                $annonce-> setStatut('V');
                $annonce-> setLogements($logement);
                $this->annoncesRepository->add($annonce, true);
                $this->message = 'Enrégistrement effectué avec succès';
            }

            $typelogements = $this->typeLogementRepository->findAll();

            return $this->render('annonces/annonce.html.twig', [
            'typelogements' => $typelogements, 'message' => $this->message,]);
        }
    }


    // contrôle des saisies
    public function controle($data) {

        if($data['typeLogement'] === null or $data['typeLogement'] === "..."){
                $this->message = 'Veuillez choisie le type de logement';
        }

        if($data['description'] === null or $data['description'] === ""){
                $this->message = "Veuillez saisir la description du logement";
        }

        if($data['descriptionA'] === null or $data['descriptionA'] === ""){
                $this->message = "Veuillez saisir la description de l'annonce";
        }


        if($data['nbPieces'] === null or $data['nbPieces'] === ""){
                $this->message = 'Veuillez saisir le nombre de pièce';
        }
        if($data['numeroEtage'] === null or $data['numeroEtage'] === ""){
                $this->message = 'Veuillez saisir le numero étage';
        }

        if($data['superficie'] === null or $data['superficie'] === ""){
                $this->message = 'Veuillez saisir la superficie';
        }

        if($data['proprietaire'] === null or $data['proprietaire'] === ""){
                $this->message = 'Veuillez saisir le proprietaire';
        }

        if($data['adresseComplete'] === null or $data['adresseComplete'] === ""){
                $this->message = "Veuillez saisir l'adresse complète";
        }

        if($data['cp'] === null or $data['cp'] === ""){
                $this->message = 'Veuillez saisir le code postal';
        }

        if($data['ville'] === null or $data['ville'] === ""){
                $this->message = "Veuillez saisir la ville";
        }

        if($data['pays'] === null or $data['pays'] === ""){
            $this->message = "Veuillez saisir la ville";
        }
    }
}
