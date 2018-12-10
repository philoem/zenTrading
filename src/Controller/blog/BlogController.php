<?php

namespace App\Controller\blog;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(UsersRepository $repo)
    {
        
        $user = $repo->findAll();
        
        return $this->render('frontend/blog/blog.html.twig', [
            'user' => $user
        ]);
    }
}
