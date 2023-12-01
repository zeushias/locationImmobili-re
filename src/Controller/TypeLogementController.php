<?php

namespace App\Controller;

use App\Entity\TypeLogement;
use App\Repository\TypeLogementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeLogementController extends AbstractController
{
    // déclarations 

    private $message;
    private $typeLogementRepository;

    
    public function __construct(TypeLogementRepository $typeLogementRepository)
    {
        $this->typeLogementRepository = $typeLogementRepository;
    }
 
   #[Route('/typelogement/add', name: 'app_type_logement')]
    public function index(): Response
    {
        return $this->render('type_logement/typelogement.html.twig', [
            'typeLogement' => '', 'message' => '',
        ]);
    }
      
    #[Route('/typelogement/add/{id}', name: 'app_type_logement_id')]
    public function index2($id): Response
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
        if($request->isMethod('POST')){
            $data = $request->request->all();
            
            //contrôle 
            if($data['libelle'] === null or $data['libelle'] === ""){
                $message = 'Veuillez saisir le libellé';
        } else {

            // typelogement
            $typelogement = new TypeLogement;
            $typelogement-> setLibelle($data['libelle']);           

            $this->typeLogementRepository->add($typelogement, true);

            $message = 'Enrégistrement effectué avec succès';
        }
        return $this->render('type_logement/typelogement.html.twig', [
            'message' => $message,]);

        }
    }


    #[Route('/typelogement/', name: 'app_type_logement')]
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

    public function updateCustomer(TypeLogement $typelogement): TypeLogement
    {
        $this->manager->persist($typelogement);
        $this->manager->flush();

        return $customer;
    }

}
