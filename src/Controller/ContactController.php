<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
        $result = "";
        $data = $request->query->all();
        if (isset($data['result'])) {
            $result = $data['result'];
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController', 'result' => $result
        ]);
    }

    /**
     * @Route("/email", name="send_email")
     */
    public function sendEmail(Request $request, ContactRepository $contactRepository, \Swift_Mailer $mailer)
    {
        $result = "vide";
        $data = $request->request->all();
        $to = 'Eloudi_Abdelati@outlook.fr';
        if (!empty($data['message']) && !empty($data['email']) && !empty($data['name']) && !empty($data['subject'])) {

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom($data['email'])
                ->setTo($to)
                ->setSubject($data['subject'])
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        [
                            'message' => $data['message'],
                            'from' => $data['email'],
                            'name' => $data['name'],
                            'subject' => $data['subject'],
                            
                        ]
                    ),
                    'text/html'
                );
            $mailer->send($message);
            $result = "succee";
            return $this->redirectToRoute('contact', ['result' => $result]);
        }

        return $this->redirectToRoute('contact', ['result' => $result]);
    }
}
