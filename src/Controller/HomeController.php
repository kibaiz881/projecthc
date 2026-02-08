<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Repository\ProfilesRepository;
use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PublicationRepository $pubrepo,ProfilesRepository $profilesRepository): Response
    {
        return $this->render('home/index.html.twig', [
            "publications" => $pubrepo->findBy(['isPublished' => false], ['postAt' => 'DESC'], 10),
            "profiles" => $profilesRepository->findAll()
        ]);
    }

}
