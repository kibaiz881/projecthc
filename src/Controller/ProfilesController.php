<?php

namespace App\Controller;

use App\Entity\Profiles;
use App\Form\ProfileFormType;
use App\Repository\ProfilesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
// Add the correct import for Request if you need to use it
use Symfony\Component\HttpFoundation\Request;

final class ProfilesController extends AbstractController
{
#[Route('/profiles', name: 'app_profiles')]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $profile = new Profiles();
    $form = $this->createForm(ProfileFormType::class, $profile);
    $form->handleRequest($request);
    $entityManager->persist($profile);
    $entityManager->flush();
    $this->addFlash('success', 'Profiles enregistré avec succès !');

    // // 4. Redirige vers une autre page (ex: la liste des produits)

    //affiche profiles image
    return $this->render('profiles/index.html.twig', [
        'controller_name' => 'ProfilesController',
        'form' => $form->createView(),
    ]);
}
}
