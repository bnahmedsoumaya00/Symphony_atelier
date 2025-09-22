<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
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

}
