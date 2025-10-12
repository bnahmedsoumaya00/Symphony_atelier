<?php
namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function home()
    {
        return $this->render('blog/index.html.twig');
    }

    /**
     * @Route("/blog", name="article_list")
     */
    public function acceuil()
    {
        //récupérer tous les articles de la table article de la BD
        // et les mettre dans le tableau $articles
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('blog/acceuil.html.twig', ['articles' => $articles]);
    }

    /**
     * Démo : transmettre un nom à la vue
     * @Route("/test-nom/{name}", name="app_test_nom")
     */
    public function testNom(string $name): Response
    {
        return $this->render('blog/test_nom.html.twig', [
            'title' => 'Bienvenue ' . ucfirst($name),
            'name'  => ucfirst($name)
        ]);
    }

    /**
     * @Route("/save")
     */
    public function save()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = new Article();
        $article->setNom('Article 3');
        $article->setPrix(3000);
        $entityManager->persist($article);
        $entityManager->flush();
        return new Response('Article enregisté avec id'.$article->getId());
    }  

    /**
     * @Route("/blog/show", name="app_show")
     */
    public function show(): Response
    {
        return $this->render('blog/show.html.twig');
    }

    /**
     * @Route("/blog/new", name="new_article")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $article = new Article();
        $form = $this->createFormBuilder($article)
            ->add('nom', TextType::class)
            ->add('prix', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Créer'))
            ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('article_list');
        }
        
        return $this->render('blog/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/blog/{id}", name="article_show")
     */
    public function details($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        
        // Vérifier si l'article existe
        if (!$article) {
            throw $this->createNotFoundException('L\'article demandé n\'existe pas.');
        }
        
        return $this->render('blog/details.html.twig', array('article' => $article));
    }

    /**
     * @Route("/blog/edit/{id}", name="edit_article")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        
        $form = $this->createFormBuilder($article)
            ->add('nom', TextType::class)
            ->add('prix', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Modifier'))
            ->getForm();
            
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('article_list');
        }
        
        return $this->render('blog/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/blog/delete/{id}", name="delete_article")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();
        //$response = new Response();
        // $response->send();
        return $this->redirectToRoute('article_list');
    }

    /**
     * @Route("/blog/modify", name="modify_list")
     */
    public function modifyList()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('blog/modify_list.html.twig', ['articles' => $articles]);
    }
}


