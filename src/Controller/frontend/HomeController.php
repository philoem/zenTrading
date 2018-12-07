<?php

namespace App\Controller\frontend;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomeController extends Controller
{

    /**
     * 
     * @Route("/", name="home")
     * 
     */
    public function index(): Response
    {
        return $this->render('frontend/home.html.twig');
    }
    /**
    * 
    * @Route("/about", name="about")
    * 
    */
    public function about(): Response
    {
        return $this->render('frontend/home.html.twig');
    }
    /**
    * 
    * @Route("/section_formules", name="section_formules")
    * 
    */
    public function section_formules(): Response
    {
        return $this->render('frontend/home.html.twig');
    }
    /**
    * 
    * @Route("/link_direct_login", name="link_direct_login")
    * 
    */
    public function link_direct_login(): Response
    {
        return $this->render('frontend/home.html.twig');
    }
    /**
     * 
     * @Route("/members", name="members")
     * 
     */
    public function loginAction(): Response
    {
        return $this->render('login/login.html.twig');
    }
    /**
    * 
    * @Route("/contact", name="contact")
    * 
    */
    public function contact(): Response
    {
        return $this->render('frontend/home.html.twig');
    }

    /**
     * 
     * @Route("/suscriber", name="suscriber")
     * 
     */
     public function suscriber()
     {
         
         return $this->render('backend/suscriber.html.twig');
     }

    

    


}