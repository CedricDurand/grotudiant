<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

//bundle à dl !
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {

       // $entityManager = $this->getDoctrine()->getManager();
       //
       // $post = new Post();
       // $post->setTitre('Titre random : '.rand());
       // $post->setContent('test'.rand());
       // $post->setUrlAlias("toto".rand());
       // $post->setPublished(new \DateTime());
       //
       // // tell Doctrine you want to (eventually) save the Product (no queries yet)
       // $entityManager->persist($post);
       //
       // // actually executes the queries (i.e. the INSERT query)
       // $entityManager->flush();


        $entityManager = $this->getDoctrine()->getRepository(Post::class);
        $donnees = $entityManager->createQueryBuilder("posts");

        $articles = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );

        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/admin/del/{id}", name="suppression")
     */
    function delUser(int $id)
    {
        // Changer par urlAlias ici et dans l'html !!! TODO
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $postDeleted = $repository->find($id);
        $entityManager->remove($postDeleted);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
    }
}
