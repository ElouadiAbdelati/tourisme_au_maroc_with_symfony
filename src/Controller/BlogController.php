<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\CommentaireBlog;
use App\Entity\Tag;
use App\Repository\BlogRepository;
use App\Repository\CategorieRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    

    /**
     * @Route("/blog", name="blog")
     */
  
    public function index(Request $request,TagRepository $tagRepository, PaginatorInterface $paginator,CategorieRepository $categorieRepository, BlogRepository $blogRepository)
    {
         
        $categories= $categorieRepository->findBlogByPublished();
        $blogs = $blogRepository->findBlogByPublished();
        $tags = $tagRepository->findAll();
        $blogs = $paginator->paginate(
            $blogs,
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'blog',
            'categories'=>$categories,
            'blogs' => $blogs,
            'tags' => $tags
        ]);
    }
    /**
     * @Route("/categorie/blog/{id}", name="category_blogs")
     */
    public function categoryBlogs(Request $request, Categorie $categorie, PaginatorInterface $paginator, TagRepository $tagRepository, CategorieRepository $categorieRepository, BlogRepository $blogRepository)
    {
         $categories= $categorieRepository->findBlogByPublished();
        $tags = $tagRepository->findAll();
        $blogs = $paginator->paginate(
           $blogRepository->findBlogByCategorieAndPublished($categorie),
            $request->query->getInt('page', 1),
            4
        );
       
        return $this->render('blog/category_blogs.html.twig', [
            'controller_name' => 'blog',
            'categories' => $categories,
             'blogs' => $blogs,
            'tags' => $tags,
            'categorie' => $categorie,
        ]);
    }
    /**
     * @Route("tag/{id}", name="tag_blogs")
     */
    public function tagBlogs(Request $request, Tag $tag, PaginatorInterface $paginator, TagRepository $tagRepository, CategorieRepository $categorieRepository, BlogRepository $blogRepository)
    {
         $categories = $categorieRepository->findBlogByPublished();
        $tags = $tagRepository->findAll();
        $blogs = $paginator->paginate(
            $tag->getBlogs(),
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('blog/tag_blogs.html.twig', [
            'controller_name' => 'blog',
            'categories' => $categories,
             'blogs' => $blogs,
            'tags' => $tags,
            'tag' => $tag,
        ]);
    }
    /**
     * @Route("/blog/search", name="search_blog")
     */
    public function blog(Request $request,TagRepository $tagRepository, PaginatorInterface $paginator,CategorieRepository $categorieRepository,BlogRepository $blogRepository)
    {
        $blogs=$blogRepository->findByContent($request->query->get('query'));
        $tags=$tagRepository->findAll();
        $categories= $categorieRepository->findBlogByPublished();
        $blogs = $paginator->paginate(
            $blogs,
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('blog/search.html.twig', [
            'controller_name' => 'blog',
            'categories'=>$categories,
            'blogs'=>$blogs,
            'tags'=>$tags
        ]);
    }

    /**
     * @Route("/blog/commentaire", name="commentaire_blog"  )
     */
    public function commentaire(Request $request, BlogRepository $blogRepository)
    {
        $c = $request->request->get('commentaire');
        $blog = $request->request->get('blog');
        $commentaire = new CommentaireBlog();
         $error = "empty";
        if (!empty($c)) {
            $blog = $blogRepository->findOneBy(array('id' => $blog));
            $commentaire->setBlog($blog);
            $commentaire->setContent($c);
            $error = "valid";
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();
        }
        $nom = '';
        $prenom = '';
        $u='';
        if ($this->getUser()->getClient() != null) {
            $nom = $this->getUser()->getClient()->getNom();
            $prenom = $this->getUser()->getClient()->getPrenom();
            $u='client';
        } elseif ($this->getUser()->getAgriculteur() != null) {
            $nom = $this->getUser()->getAgriculteur()->getNom();
            $prenom = $this->getUser()->getAgriculteur()->getPrenom();
            $u='agriculteur';
        } else {
            $nom = $this->getUser()->getAdmin()->getNom();
            $prenom = $this->getUser()->getAdmin()->getPrenom();
            $u='admin';
        }
        $data = $this->get('serializer')->serialize(
            [
                'commentaire' => $commentaire->getContent(),
                'nom' => $nom,
                'prenom' => $prenom,
                'error' => $error,
                'user'=>$u
            ],
            'json'
        );
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
