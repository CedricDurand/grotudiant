<?php
// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
    * @Route("/", name="index_blog")
    */
    public function index()
    {
      return $this->render('blog/index.html.twig', [
        'pageTitle' => 'accueil',
      ]);
    }

    /**
    * @Route("/post/{id}", name="info_blog")
    */
    public function detail(int $id)
    {
      return $this->render('blog/detail.html.twig', [
        'id' => $id,
        'pageTitle' => $id,
      ]);
    }
}
