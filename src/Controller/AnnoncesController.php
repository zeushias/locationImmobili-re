<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\annonces;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoncesController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/annonces', name: 'app_annonces')]
    public function index(): Response
    {
        return $this->render('annonces/annonce.html.twig', [
            'controller_name' => 'AnnoncesController',
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

            // annonce
            $annonce = new annonces;
            $annonce-> setLibelle($data['dateMiseEnLigne']);
            $annonce-> setLibelle($data['description']);

            $this->$em->persist($annonce);
            $this->$em->flush();
        }
    }

}
