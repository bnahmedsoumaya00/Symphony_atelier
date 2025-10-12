<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function home(): Response
    {
        return $this->render('blog/index.html.twig');
    }

    /**
     * @Route("/blog", name="article_list")
     */
    public function acceuil(EntityManagerInterface $em): Response
    {
        $articles = $em->getRepository(Article::class)->findAll();
        return $this->render('blog/acceuil.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
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
     * @Route("/save", name="demo_save")
     */
    public function save(EntityManagerInterface $em): Response
    {
        $article = new Article();
        $article->setNom('Article de démo');
        $article->setPrix(99.99);
        $em->persist($article);
        $em->flush();
        return new Response('✅ Article créé avec ID: ' . $article->getId());
    }

    /**
     * @Route("/blog/new", name="new_article", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();
        $form = $this->createFormBuilder($article)
            ->add('nom', TextType::class, [
                'label' => 'Nom de l\'article',
                'attr' => ['placeholder' => 'Ex: Smartphone, Livre...']
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix (DT)',
                'scale' => 2,
                'html5' => true,
                'attr' => ['min' => 0, 'step' => 0.01, 'placeholder' => 'Ex: 29.99']
            ])
            ->add('save', SubmitType::class, ['label' => '✅ Créer l\'article'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();
            $this->addFlash('success', '🎉 Article « ' . $article->getNom() . ' » ajouté avec succès !');
            return $this->redirectToRoute('article_list');
        }

        return $this->render('blog/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/{id}", name="article_show", requirements={"id"="\d+"})
     */
    public function details(Article $article): Response
    {
        return $this->render('blog/details.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/blog/edit/{id}", name="edit_article", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Article $article, EntityManagerInterface $em): Response
    {
        $form = $this->createFormBuilder($article)
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('prix', NumberType::class, [
                'label' => 'Prix (DT)',
                'scale' => 2,
                'html5' => true,
                'attr' => ['min' => 0, 'step' => 0.01]
            ])
            ->add('save', SubmitType::class, ['label' => '💾 Enregistrer les modifications'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', '✏️ Article mis à jour avec succès !');
            return $this->redirectToRoute('article_list');
        }

        return $this->render('blog/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/delete/{id}", name="delete_article", methods={"POST"}, requirements={"id"="\d+"})
     */
    public function delete(Article $article, EntityManagerInterface $em): Response
    {
        $nom = $article->getNom();
        $em->remove($article);
        $em->flush();
        $this->addFlash('success', '🗑️ Article « ' . $nom . ' » supprimé.');
        return $this->redirectToRoute('article_list');
    }

    // Optional: Handle accidental GET delete with redirect
    /**
     * @Route("/blog/delete/{id}", name="delete_article_get", methods={"GET"})
     */
    public function deleteGet(): Response
    {
        $this->addFlash('error', '⚠️ Opération non autorisée. Utilisez le bouton de confirmation.');
        return $this->redirectToRoute('article_list');
    }

    /**
     * @Route("/blog/modify", name="modify_list")
     */
    public function modifyList(EntityManagerInterface $em): Response
    {
        $articles = $em->getRepository(Article::class)->findAll();
        return $this->render('blog/modify_list.html.twig', ['articles' => $articles]);
    }
}