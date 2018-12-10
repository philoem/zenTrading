<?php

namespace App\Controller\backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Users;
use App\Form\AdminType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/suscriber", name="suscriber")
     */
    public function show(Request $request, EntityManagerInterface $em,  UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getUser();
        
        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            /* Ici affichage d'un message confirmant l'enregistrement du message */
            $this->addFlash(
                'notice',
                'Sauvegarde effectuée !'
            );

            return $this->render('security_login');
        }

        $form_suscriber = $form->createView();
        
        return $this->render('backend/suscriber.html.twig', [
            'form_suscriber' => $form_suscriber,
            'user'           => $user
        ]);
    }
}
