<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccessDeniedHandlerController extends AbstractController
{
    /**
     * @Route("/access/denied", name="access_denied_handler")
     */
    public function index()
    {
        return $this->render('bundles/TwigBundle/Exception/error403.html.twig');
    }
}
