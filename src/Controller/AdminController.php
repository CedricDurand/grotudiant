<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {

       $entityManager = $this->getDoctrine()->getManager();

       $post = new Post();
       $post->setTitre('Titre random : '.rand());
       $post->setContent('test'.rand());
       $post->setUrlAlias("toto".rand());
       $post->setPublished(new \DateTime());

       // tell Doctrine you want to (eventually) save the Product (no queries yet)
       $entityManager->persist($post);

       // actually executes the queries (i.e. the INSERT query)
       $entityManager->flush();

       return new Response('Saved new post with id '.$post->getId());


        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
