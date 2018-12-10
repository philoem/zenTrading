<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\LoginType;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
    * @Route("/home", name="security_login", defaults={"_fragment" = "login"})
    */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        $user = new Users();
        $form_login = $this->createForm(LoginType::class, $user);
        $form_login->handleRequest($request);
        //$formView2 = $form_login->createView();

        if($form_login->isSubmitted() && $form_login->isValid()){
            
            return $this->redirectToRoute('home', [
                '_fragment' => 'login'
            ]);
        } 
        
        return $this->redirectToRoute('home', [
            'last_username'     => $lastUsername,
            'error'             => $error,
            '_fragment'         => 'login'
        ]);
    }
    
    /**
     * 
     * @Route("/registration", name="security_registration")
     * 
     */
    public function registration(Request $request, ObjectManager $manager,  UserPasswordEncoderInterface $encoder) 
    {
        $user = new Users();
        $form_registration = $this->createForm(RegistrationType::class, $user);

        $form_registration-> handleRequest($request);

        if($form_registration->isSubmitted() && $form_registration->isValid()) {
            
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login', [
                '_fragment' => 'login'
            ]);
        }

        return $this->render('security/registration.html.twig', [
            'form_registration' => $form_registration->createView()
        ]);
    }

    /**
     * 
     * @Route("/logout", name="security_logout")
     *
     */
    public function logout()
    {

    }

    

}
