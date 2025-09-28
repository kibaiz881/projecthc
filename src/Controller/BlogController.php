<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PublicationRepository;

final class BlogController extends AbstractController
{
    #[Route('/blog/{page}/{ItemPerPage}', name: 'app_blog')]
    public function index(PublicationRepository $pubrepo, int $page = 1, $ItemPerPage = 10 ): Response
    {
        // Paginer les résultats
        $publications = $pubrepo->createQueryBuilder('p')
            ->setFirstResult(($page - 1) * $ItemPerPage)
            ->setMaxResults($ItemPerPage)
            ->getQuery()
            ->execute();

        return $this->render('blog/index.html.twig', [
            'publications' => $publications,
            'currentPage' => $page,
            'itemsPerPage' => $ItemPerPage,
            'totalItems' => $pubrepo->count([]),
            'totalPages' => ceil($pubrepo->count([]) / $ItemPerPage),
        ]);
    }
}
