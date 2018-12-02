<?php

namespace App\Controller\frontend;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


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
     * @Route("/formules", name="formules")
     * 
     */
     public function choice(): Response
     {
         return $this->render('frontend/home.html.twig');
     }


}