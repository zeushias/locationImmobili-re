<?php

namespace App\Controller;
use App\Entity\TypeLogement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    

    /**
     * @Route("/", name="app_pins")
     */
    public function index(): Response
    {
        return $this->render('pins/index.html.twig', [
            'controller_name' => 'PinsController',
        ]);
    }
}
