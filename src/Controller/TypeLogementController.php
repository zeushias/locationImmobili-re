<?php

namespace App\Controller;

use App\Entity\TypeLogement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeLogementController extends AbstractController
{
    // déclarations 

    private $message;
    //private $em = null;

    /*public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }*/

    #[Route('/typelogement', name: 'app_type_logement')]
    public function index(): Response
    {
        return $this->render('type_logement/typelogement.html.twig', [
            'controller_name' => '',
        ]);
    }

    /**
    *@Route("/typelogement/create", methods={"POST"})
    */
    public function create(Request $request)
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

            $em = $this->getDoctrine()->getManager();
            
            $em->persist($typelogement);
            $em->flush();
            $message = 'Enrégistrement effectué avec succès';
        }
        return $this->render('type_logement/typelogement.html.twig', [
            'controller_name' => $message,]);

        }
    }
}
