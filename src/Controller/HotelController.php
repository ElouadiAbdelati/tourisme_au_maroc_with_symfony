<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\HotelLike;
use App\Repository\HotelLikeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hotel")
 */
class HotelController extends AbstractController
{
     /**
     * @Route("/{id}/like", name="hotel_like")
     */
    public function like(Hotel $hotel, HotelLikeRepository $hotelLikeRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['code' => 403, 'message' => 'Unthauthorized'], 403);
        }
        $entityManager = $this->getDoctrine()->getManager();
        if ($hotel->isLikedByUser($user)) {

            $like = $hotelLikeRepository->findOneBy(['hotel' => $hotel, 'user' => $user]);
            $entityManager->remove($like);
            $entityManager->flush();
            return $this->json([
                'code' => 200,
                'message' => 'like bien supprimer ',
                'likes' => $hotelLikeRepository->count(['hotel' => $hotel])
            ], 200);
        }
        $like = new HotelLike();
        $like->setHotel($hotel);
        $like->setUser($user);
        $entityManager->persist($like);
        $entityManager->flush();
        return $this->json([
            'code' => 200,
            'message' => 'like bien ajouter ',
            'likes' => $hotelLikeRepository->count(['hotel' => $hotel])
        ], 200);
    }
}
