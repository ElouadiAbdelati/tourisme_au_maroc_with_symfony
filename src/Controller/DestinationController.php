<?php

namespace App\Controller;

use App\Entity\Region;
use App\Entity\Ville;
use App\Repository\RegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VilleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DestinationController extends AbstractController
{  
    
    /**
     * @Route("/destination", name="destination")
     */
    public function index(VilleRepository $villeRepository,RegionRepository $regionRepository)
    {    
        $villes = $villeRepository->findAll();
       
        $regions=$regionRepository->findRegionsNotEmpty();
        foreach ($regions as $region){
           $vs=$villeRepository->findBy(array('region'=>$region));
           foreach($vs as $v){
            $region->addVille($v);
           }
        }
        
        return $this->render('destination/index.html.twig', [
            'controller_name' => 'DestinationController', 'villes' => $villes,'regions'=>$regions
        ]);
    }

     /**
     * @Route("/destination/filter", name="destination_filter")
     */
    public function filterDestination(Request $request,VilleRepository $villeRepository,RegionRepository $regionRepository) :Response
    {    
        //if 0 => all regions
        $region = $request->request->get('id');
        if( $region == 0){
           $villes = $villeRepository->findAll();
        }else{
           $villes = $villeRepository->findBy(array('region'=>$region));
        }
        $villes1 = [];
        foreach($villes as $v){
           array_push($villes1,$v->getName());
       }
 
       $serializer =$this->get('serializer');
       $data= $serializer->serialize(['villes'=>$villes1], 'json');
       $response = new Response($data);
       $response->headers->set('Content-Type', 'application/json');

      return $response;   
    }
}
