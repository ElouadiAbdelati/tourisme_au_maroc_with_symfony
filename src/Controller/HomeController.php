<?php

namespace App\Controller;

use App\Repository\RegionRepository;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/")
     */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(VilleRepository $villeRepository)
    { 
        $villes = $villeRepository->findAll();
      
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController','villes'=>$villes,
        ]);
    }
}
