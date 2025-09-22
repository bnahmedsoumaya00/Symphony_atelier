<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
Use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function index(Request $request): Response
    {
        $age = null;
        
        // Gérer la soumission du formulaire
        if ($request->isMethod('POST')) {
            $age = $request->request->get('age');
            $age = $age ? (int)$age : null;
        }
        
        return $this->render('blog/acceuil.html.twig', [
            'title' => 'bienvenu souhir',
            'age' => $age
        ]);
    }

    /**
     * @Route("/{age}")
     */
    public function homeWithAge($age): Response
    {
        return $this->render('blog/acceuil.html.twig', [
            'title' => 'bienvenu souhir',
            'age' => $age
        ]);
    }
}
