<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\ActiviteLike;
use App\Form\Activite2Type;
use App\Repository\ActiviteLikeRepository;
use App\Repository\ActiviteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activite")
 */
class ActiviteController extends AbstractController
{
     /**
     * @Route("/{id}/like", name="activite_like")
     */
    public function like(Activite $activite,ActiviteLikeRepository $activiteLikeRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['code' => 403, 'message' => 'Unthauthorized'], 403);
        }
        $entityManager = $this->getDoctrine()->getManager();
        if ($activite->isLikedByUser($user)) {

            $like = $activiteLikeRepository->findOneBy(['activite' => $activite, 'user' => $user]);
            $entityManager->remove($like);
            $entityManager->flush();
            return $this->json([
                'code' => 200,
                'message' => 'like bien supprimer ',
                'likes' => $activiteLikeRepository->count(['activite' => $activite])
            ], 200);
        }
        $like = new ActiviteLike();
        $like->setActivite($activite);
        $like->setUser($user);
        $entityManager->persist($like);
        $entityManager->flush();
        return $this->json([
            'code' => 200,
            'message' => 'like bien ajouter ',
            'likes' => $activiteLikeRepository->count(['activite' => $activite])
        ], 200);
    }
}
