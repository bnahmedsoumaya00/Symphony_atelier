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
use App\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\CategoryRepository;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Entity\CategorySearch;
use App\Form\CategorySearchType;
use App\Entity\PriceSearch;
use App\Form\PriceSearchType;

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
    public function acceuil(Request $request, EntityManagerInterface $em): Response
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $propertySearch);
        $form->handleRequest($request);
        
        // Par défaut, on affiche TOUS les articles
        $articles = $em->getRepository(Article::class)->findAll();
        
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère le nom d'article tapé dans le formulaire
            $nom = $propertySearch->getNom();
            
            if ($nom != "") {
                // Si on a fourni un nom d'article, on filtre par nom
                $articles = $em->getRepository(Article::class)->findBy(['nom' => $nom]);
            }
            // Si le champ est vide, on garde tous les articles (déjà chargés)
        }
        
        return $this->render('blog/acceuil.html.twig', [
            'form' => $form->createView(),
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/blog/articlesParCategorie", name="article_par_cat")
     * @Method({"GET", "POST"})
     */
    public function articlesParCategorie(Request $request, EntityManagerInterface $em): Response
    {
        $categorySearch = new CategorySearch();
        $form = $this->createForm(CategorySearchType::class, $categorySearch);
        $form->handleRequest($request);
        
        // Par défaut, on affiche TOUS les articles
        $articles = $em->getRepository(Article::class)->findAll();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $categorySearch->getCategory();
            
            if ($category != null) {
                // Si une catégorie est sélectionnée, on affiche ses articles
                $articles = $category->getArticles();
            }
            // Sinon on garde tous les articles (déjà chargés)
        }
        
        return $this->render('blog/articlesParCategorie.html.twig', [
            'form' => $form->createView(),
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/blog/articlesParPrix", name="article_par_prix")
     * @Method({"GET", "POST"})
     */
    public function articlesParPrix(Request $request, EntityManagerInterface $em): Response
    {
        $priceSearch = new PriceSearch();
        $form = $this->createForm(PriceSearchType::class, $priceSearch);
        $form->handleRequest($request);
        
        // Par défaut, on affiche TOUS les articles
        $articles = $em->getRepository(Article::class)->findAll();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $minPrice = $priceSearch->getMinPrice();
            $maxPrice = $priceSearch->getMaxPrice();
            
            // Si les deux valeurs sont fournies, on recherche par fourchette
            if ($minPrice !== null && $maxPrice !== null) {
                $articles = $em->getRepository(Article::class)
                    ->findByPriceRange($minPrice, $maxPrice);
            }
            // Sinon on garde tous les articles (déjà chargés)
        }
        
        return $this->render('blog/articlesParPrix.html.twig', [
            'form' => $form->createView(),
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
        return new Response('Article créé avec ID: ' . $article->getId());
    }

    /**
     * @Route("/blog/new", name="new_article")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();
            $this->addFlash('success', 'Article ajouté avec succès !');
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
     * @Route("/blog/edit/{id}", name="edit_article")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $article = $em->getRepository(Article::class)->find($id);
        
        if (!$article) {
            throw $this->createNotFoundException('Article introuvable.');
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Article mis à jour avec succès !');
            return $this->redirectToRoute('article_list');
        }

        return $this->render('blog/new.html.twig', [
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
        $this->addFlash('success', 'Article « ' . $nom . ' » supprimé avec succès.');
        return $this->redirectToRoute('article_list');
    }

    /**
     * @Route("/blog/delete/{id}", name="delete_article_get", methods={"GET"})
     */
    public function deleteGet(): Response
    {
        $this->addFlash('error', 'Opération non autorisée. Utilisez le bouton de confirmation.');
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

    /**
     * @Route("/category/newCat", name="new_category")
     * @Method({"GET", "POST"})
     */
    public function newCategory(Request $request, EntityManagerInterface $em): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Catégorie ajoutée avec succès !');
            return $this->redirectToRoute('article_list');
        }

        return $this->render('blog/newCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/categories", name="category_list")
     */
    public function categoryList(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        
        return $this->render('blog/categoryList.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}/edit", name="edit_category", requirements={"id"="\d+"})
     */
    public function editCategory(Request $request, Category $category, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            
            $this->addFlash('success', 'La catégorie a été modifiée avec succès !');
            
            return $this->redirectToRoute('category_list');
        }

        return $this->render('blog/editCategory.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/category/{id}/delete", name="delete_category", methods={"POST"})
     */
    public function deleteCategory(Request $request, Category $category, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            if ($category->getArticles()->count() > 0) {
                $this->addFlash('error', 'Impossible de supprimer une catégorie qui contient des articles.');
            } else {
                $em->remove($category);
                $em->flush();
                
                $this->addFlash('success', 'La catégorie "' . $category->getTitre() . '" a été supprimée avec succès !');
            }
        } else {
            $this->addFlash('error', 'Token CSRF invalide.');
        }

        return $this->redirectToRoute('category_list');
    }
}
