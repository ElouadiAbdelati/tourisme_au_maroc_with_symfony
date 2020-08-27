<?php

namespace App\Controller;

use App\Entity\Resto;
use App\Entity\RestoLike;
use App\Form\Resto3Type;
use App\Repository\RestoLikeRepository;
use App\Repository\RestoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/resto")
 */
class RestoController extends AbstractController
{
     /**
     * @Route("/{id}/like", name="resto_like")
     */
    public function like(Resto $resto, RestoLikeRepository $restoLikeRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['code' => 403, 'message' => 'Unthauthorized'], 403);
        }
        $entityManager = $this->getDoctrine()->getManager();
        if ($resto->isLikedByUser($user)) {

            $like = $restoLikeRepository->findOneBy(['resto' => $resto, 'user' => $user]);
            $entityManager->remove($like);
            $entityManager->flush();
            return $this->json([
                'code' => 200,
                'message' => 'like bien supprimer ',
                'likes' => $restoLikeRepository->count(['resto' => $resto])
            ], 200);
        }
        $like = new RestoLike();
        $like->setResto($resto);
        $like->setUser($user);
        $entityManager->persist($like);
        $entityManager->flush();
        return $this->json([
            'code' => 200,
            'message' => 'like bien ajouter ',
            'likes' => $restoLikeRepository->count(['resto' => $resto])
        ], 200);
    }
}
