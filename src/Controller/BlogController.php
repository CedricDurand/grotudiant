<?php
// src/Controller/BlogController.php
namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
    * @Route("/", name="index_blog")
    */
    public function index()
    {

      $entityManager = $this->getDoctrine()->getRepository(Post::class);
      $articles = $entityManager->findBy(array(), array('published' => 'DESC'));


      return $this->render('blog/index.html.twig', [
        'pageTitle' => 'accueil',
        'articles' => $articles
      ]);
    }

    /**
    * @Route("/post/{alias}", name="info_blog")
    */
    public function detail(string $alias)
    {

      $entityManager = $this->getDoctrine()->getRepository(Post::class);
      $article = $entityManager->findOneBy(['url_alias' => $alias]);

      if($article == null){
        return $this->redirectToRoute('index_blog');
      }

      return $this->render('blog/detail.html.twig', [
        'alias' => $alias,
        'pageTitle' => $alias,
        'article'=> $article
      ]);
    }
}
