<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Entity\CampingLike;
use App\Form\Camping2Type;
use App\Repository\CampingLikeRepository;
use App\Repository\CampingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/camping")
 */
class CampingController extends AbstractController
{
     /**
     * @Route("/{id}/like", name="camping_like")
     */
    public function like(Camping $camping, CampingLikeRepository $campinglLikeRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['code' => 403, 'message' => 'Unthauthorized'], 403);
        }
        $entityManager = $this->getDoctrine()->getManager();
        if ($camping->isLikedByUser($user)) {

            $like = $campinglLikeRepository->findOneBy(['camping' => $camping, 'user' => $user]);
            $entityManager->remove($like);
            $entityManager->flush();
            return $this->json([
                'code' => 200,
                'message' => 'like bien supprimer ',
                'likes' => $campinglLikeRepository->count(['camping' => $camping])
            ], 200);
        }
        $like = new CampingLike();
        $like->setCamping($camping);
        $like->setUser($user);
        $entityManager->persist($like);
        $entityManager->flush();
        return $this->json([
            'code' => 200,
            'message' => 'like bien ajouter ',
            'likes' => $campinglLikeRepository->count(['camping' => $camping])
        ], 200);
    }
}
