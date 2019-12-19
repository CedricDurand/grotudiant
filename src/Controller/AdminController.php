<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\CreatePostType;
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

    /**
     * @Route("/admin/modif/{id}", name="modification")
     */
    function modifUser(Request $request, int $id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $article = $repository->find($id);
        $form = $this->createform(CreatePostType::class,$article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

          $article = $form->getData();
          $article->setPublished(new \DateTime('today'));
          $entityManager->flush();

          return $this->redirectToRoute('admin');
        }

        return $this->render('admin/updatePost.html.twig',[
          'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/admin/add", name="ajout")
     */
    function addPost(Request $request){
      $newPost = new Post();

      $form = $this->createform(CreatePostType::class,$newPost);

      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $newPost = $form->getData();
        $newPost->setPublished(new \DateTime('today'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($newPost);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
      }

      return $this->render('admin/createPost.html.twig',[
        'form'=>$form->createView(),
      ]);
    }
}
