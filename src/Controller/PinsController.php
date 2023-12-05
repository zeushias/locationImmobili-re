<?php

namespace App\Controller;
use App\Entity\TypeLogement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Controller\TypeLogementController;
use App\Controller\UtilisateurController;

class PinsController extends AbstractController
{
    

    /**
     * @Route("/", name="app_pins")
     */
    public function index(): Response
    {
        return $this->render('pins/index.html.twig', [
            'controller_name' => '',
        ]);
    }


    /**
     * @Route("/", name="app_pins_user")
     */
    public function indexUser(): Response
    {
        return $this->render('pins/indexUser.html.twig', [
            'controller_name' => '',
        ]);
    }

    
}
