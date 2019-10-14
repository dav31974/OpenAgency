<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{

    /**
     * -----Permet d'afficher tous les biens-----
     * @Route("/biens", name="property_index")
     * @return Response
     */
    public function index(PropertyRepository $repo, ObjectManager $manager)
    {
        $properties = $repo->findAllVisible();
        return $this->render('property/index.html.twig', [
            'properties' => $properties,
            'current_menu' => 'properties'
        ]);
    }

    /**
     * -----Permet d'afficher un bien-----
     * @Route("/biens/{slug}/{id}", name="property_show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, $slug)
    {
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property_show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }

    
}
