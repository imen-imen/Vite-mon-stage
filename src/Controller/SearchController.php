<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route(path: '/search', name: 'search')]

public function search(Request $request, OfferRepository $offerRepository): Response
{
    $title = $request->query->get('title');
    $localisation = $request->query->get('localisation');
    $offers = $offerRepository->searchOffers($title,$localisation);

    return $this->render('index/search.html.twig', [
        'offers' => $offers,
    ]);
}

}
