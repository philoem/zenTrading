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
        
        //$user = new Users();
        $form_suscriber = $this->createForm(AdminType::class, $user);
        $form_suscriber->handleRequest($request);

        if($form_suscriber->isSubmitted() && $form_suscriber->isValid()) {
            
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->render('security_login');
        }
        
        return $this->render('backend/suscriber.html.twig', [
            'form_suscriber' => $form_suscriber->createView(),
            'user'           => $user
        ]);
    }
}
