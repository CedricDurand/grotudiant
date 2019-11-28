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
    * @Route("/post/{id}", name="info_blog")
    */
    public function detail(int $id)
    {

      $entityManager = $this->getDoctrine()->getRepository(Post::class);
      $article = $entityManager->find($id);
      return $this->render('blog/detail.html.twig', [
        'id' => $id,
        'pageTitle' => $id,
        'article'=> $article
      ]);
    }

    /**
    * @Route("/get/{url}", name="get_post")
    */
    public function getPost(string $url){
      $entityManager = $this->getDoctrine()->getRepository(Post::class);
      $article = $entityManager->findOneBy(['url_alias'=>$url]);
      return $this->render('blog/getPost.html.twig', [
        'pageTitle' => 'accueil',
        'article'=> $article,
      ]);
    }
}
