<?php

namespace App\Controller;

use App\Entity\Comentaire;
use App\Repository\MarkerRepository;
use App\Repository\HotelRepository;
use App\Repository\RestoRepository;
use App\Repository\ActiviteRepository;
use App\Repository\CampingRepository;
use App\Repository\VilleRepository;
use App\Entity\Ville;
use App\Repository\ComentaireRepository;
use PhpParser\Node\Expr\Empty_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;

class DestinationDetailsController extends AbstractController
{
  /**
   * @Route("/{name}/details", name="destination_details" , methods={"GET","POST"})
   */
  public function index(
    Request $request,
    $name,
    MarkerRepository $markerRepository,
    HotelRepository $hotelRepository,
    RestoRepository $restoRepository,
    ActiviteRepository $activiteRepository,
    CampingRepository $campingRepository,
    VilleRepository $villeRepository,
    ComentaireRepository $comentaireRepository
  ) {
    $ville = $villeRepository->findOneBy(array('name' => $name));
    $hotelMarkers = $markerRepository->findBy(array('type' => 'hotel', 'ville' => $ville));
    $restoMarkers = $markerRepository->findBy(array('type' => 'resto', 'ville' => $ville));
    $activiteMarkers = $markerRepository->findBy(array('type' => 'activite', 'ville' => $ville));
    $campingMarkers = $markerRepository->findBy(array('type' => 'camping', 'ville' => $ville));
    $hotels = $hotelRepository->findBy(array('ville' => $ville));
    $restos = $restoRepository->findBy(array('ville' => $ville));
    $activites = $activiteRepository->findBy(array('ville' => $ville));
    $campings = $campingRepository->findBy(array('ville' => $ville));
    $villeMarker = $markerRepository->findOneBy(array('type' => 'ville', 'ville' => $ville));
    $comentaires = $comentaireRepository->findBy(array('ville' => $ville));
    //      dd($activites);
    return $this->render('destination_details/index.html.twig', [
      'controller_name' => 'DestinationDetailsController', 'villeMarker' => $villeMarker, 'ville' => $ville,
      'hotelMarkers' => $hotelMarkers, 'hotels' => $hotels, 'restos' => $restos, 'activites' => $activites, 'campings' => $campings,
      'restoMarkers' => $restoMarkers, 'activiteMarkers' => $activiteMarkers, 'campingMarkers' => $campingMarkers,
      'comentaires' => $comentaires,
    ]);
  }
  
  /**
   * @Route("/commentaire", name="comentaire" , methods={"GET","POST"})
   */
  public function commentaire(Request $request, VilleRepository $villeRepository, SluggerInterface $slugger)
  {   
    $c = $request->request->get('comentaire');
    $ville = $request->request->get('ville');
    $file = $request->files->get('file');
    $comentaire = new Comentaire();
    $comentaire->setUser($this->getUser());
    $error ="empty";
    $newFilename ="empty";
    if (!empty($c) || !empty($file)) {
      $ville = $villeRepository->findOneBy(array('id' => $ville));
      $comentaire->setVille($ville);
      if (!empty($c)) {
        $comentaire->setComentaire($c);
        $error = "valid";
      }
      if ($file != null) {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
        try {
          $file->move(
            $this->getParameter('brochures_directory'),
            $newFilename
          );
        } catch (FileException $e) {
        }
        $comentaire->setImage($newFilename);
      }
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($comentaire);
      $entityManager->flush();
      
    }

    $data = $this->get('serializer')->serialize(
      [
        'comentaire' => $comentaire->getComentaire(),
        'nom' => $comentaire->getUser()->getNom(),
        'prenom' => $comentaire->getUser()->getPrenom(),
        'error' => $error,
        'newFilename' => $newFilename
      ],
      'json'
    );
    $response = new Response($data);
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }
}
