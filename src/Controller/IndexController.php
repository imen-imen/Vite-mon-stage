<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findAll();
        return $this->render(
            'index/index.html.twig',
            [
                'offers' => $offers
            ]
        );
    }
    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(): Response
    {
        return $this->render('index/apropos.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/offre/{id}', name: 'app_offer_show')]
public function show(int $id, OfferRepository $offerRepository): Response
{
    $offer = $offerRepository->find($id);

    if (!$offer) {
        throw $this->createNotFoundException('Offre non trouvée.');
    }

    return $this->render('index/show.html.twig', [
        'offer' => $offer,
    ]);
}

    
}

