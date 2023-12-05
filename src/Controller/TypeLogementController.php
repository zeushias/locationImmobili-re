<?php

namespace App\Controller;

use App\Entity\TypeLogement;
use App\Repository\TypeLogementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LogementsRepository;

class TypeLogementController extends AbstractController
{
    // déclarations 

    private $message;
    private $typeLogementRepository;

    
    public function __construct(TypeLogementRepository $typeLogementRepository, LogementsRepository $logementRepository)
    {
        $this->typeLogementRepository = $typeLogementRepository;
        $this->logementRepository = $logementRepository;
        $this->message = '';
    }
    
    // afficher page de d'enrégistrement d'un type logement
   #[Route('/typelogement/add', name: 'app_type_logement')]
    public function create(): Response
    {
        return $this->render('type_logement/typelogement.html.twig', [
            'typeLogement' => '', 'message' => '',
        ]);
    }
     
    // afficher page de modification d'un type logement 
    #[Route('/typelogement/add/{id}', name: 'app_type_logement_id')]
    public function modify($id): Response
    {
        //dd((int) $id);
        $tl = $this->typeLogementRepository->findById((int) $id);

        return $this->render('type_logement/typelogement.html.twig', [
            'typeLogement' => $tl, 'message' => null,
        ]);
    }

    /**
    *@Route("/typelogement/create", methods={"POST"})
    */
    public function add(Request $request)
    {
        $typelogement = new TypeLogement;

        if($request->isMethod('POST')){
            $data = $request->request->all();

            // typelogement
            
            $typelogement-> setId($data['id']); 
            $typelogement-> setLibelle($data['libelle']); 
            //dd($typelogement);
            //contrôle 
            if($data['libelle'] === null or $data['libelle'] === ""){
                $this->message = 'Veuillez saisir le libellé';
        } else {   

            $typeLogExistant = $this->typeLogementRepository->findByLibelle($data['libelle']); 

            if($typeLogExistant != null){      

                $this->message = 'Ce libellé existe déjà! Merci';

            } else {

                $this->typeLogementRepository->add($typelogement, true);
dd($typelogement);
                $this->message = 'Enrégistrement effectué avec succès';

                return $this->render('type_logement/typelogement.html.twig', [
                    'typeLogement' => '','message' => $this->message,]);
            }
        }
        return $this->render('type_logement/typelogement.html.twig', [
            'typeLogement' => $typelogement,'message' => $this->message,]);

        }
    }

    // affichage liste des utilisateurs
    #[Route('/typelogement/', name: 'type_logement_list_page')]
    public function getAll(): Response
    {
        $typelogements = $this->typeLogementRepository->findAll();
        $data = [];

        foreach ($typelogements as $typelogement) {
            $data[] = [
                'id' => $typelogement->getId(),
                'libelle' => $typelogement->getLibelle(),
            ];
        }

        return $this->render('type_logement/typelogementList.html.twig', [
            'typelogements' => $typelogements,
        ]);
        //return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/typelogement/remove/{id}', name: 'app_type_logement')]
    public function remove($id): Response
    {
        $logement = $this->logementRepository->findByTypeLogement($id);
        if($logement != null ){
        return $this->render('type_logement/typelogement.html.twig', [
            'typeLogement' => '', 'message' => 'Ce type logement est utilisé',
        ]);
    } else {
        $tl = $this->typeLogementRepository->findById((int) $id);
        $this->typeLogementRepository->remove($tl, true);
        $typelogements = $this->typeLogementRepository->findAll();
        return $this->render('type_logement/typelogementList.html.twig', [
            'typelogements' => $typelogements, 'message' => 'Suppression effectuée',
        ]);
        
    }
    }

}
