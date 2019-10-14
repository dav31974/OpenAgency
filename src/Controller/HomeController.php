<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * Paged'accueil
     * @Route("/", name="home")
     *
     * @return Response
     */
    public function index(PropertyRepository $property)
    {
        $properties = $property->findLatest();
        return $this->render('home.html.twig', [
            'properties' => $properties
        ]);
    }

}
