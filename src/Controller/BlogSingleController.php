<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\CommentaireBlog;
use App\Form\CommentaireBlogType;
use App\Repository\BlogRepository;
use App\Repository\CategorieRepository;
use App\Repository\TagRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogSingleController extends AbstractController
{
    /**
     * @Route("/blog/{id}", name="blog_single")
     */
   
    public function index(Request $request, Blog $blog  ,TagRepository $tagRepository,
    CategorieRepository $categorieRepository)
    {
        $commentaire = new CommentaireBlog();
        $form = $this->createForm(CommentaireBlogType::class, $commentaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
              $commentaire = $form->getData();
             $commentaire->setBlog($blog);
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($commentaire);
             $entityManager->flush();
    
            return $this->redirectToRoute('blog_single',['id'=>$blog->getId()]);
        }

        $categories= $categorieRepository->findBlogByPublished();
         $tags = $tagRepository->findAll();
       
        return $this->render('blog_single/index.html.twig', [
            'controller_name' => 'blog',
            'categories'=>$categories,
            'blog' => $blog,
            'tags' => $tags,
            'form' => $form->createView()
        ]);
    }
}
