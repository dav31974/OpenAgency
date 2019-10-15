<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{

    /**
     * ----affivhes tous les bien
     * @Route("/admin", name="admin_property_index")
     *
     * @param PropertyRepository $repo
     * @return Response
     */
    public function index(PropertyRepository $repo)
    {
        $properties = $repo->findAll();
        return $this->render('admin/property/index.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * -----Permet de créer un nouveau bien
     * @Route("/admin/property/create", name="admin_property_create")
     *
     * @return Response
     */
    public function new(ObjectManager $manager, Request $request)
    {
        $property = new Property();

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($property);
            $manager->flush();
            $this->addFlash('success', "Le bien <strong>{$property->getTitle()}</strong> à bien été créer");
            return $this->redirectToRoute('admin_property_index');
        }
        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * -----Permet d'éditer un bien
     * @Route("/admin/{id}", name="admin_property_edit")
     *
     * @return Response
     */
    public function edit(Property $property, ObjectManager $manager, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            $this->addFlash('success', "Le bien <strong>{$property->getTitle()}</strong> à bien été modifier");
            return $this->redirectToRoute('admin_property_index');
        }
        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * -----permet de supprimer un bien
     * @Route("/admin/property/delete/{id}", name="admin_property_delete")
     *
     * @param Property $property
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Property $property, ObjectManager $manager)
    {
        $manager->remove($property);
        $manager->flush();
        $this->addFlash('success', "Le bien <strong>{$property->getTitle()}</strong> à bien été supprimer");
        return $this->redirectToRoute('admin_property_index');
    }

}