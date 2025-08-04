<?php

namespace App\Controller;

use App\Entity\Candidacy;
use App\Entity\Offer;
use App\Form\CandidacyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CandidacyController extends AbstractController
{
    #[Route('/candidacy/new/{id}', name: 'app_candidacy_new')]
    public function new(Request $request, Offer $offer, EntityManagerInterface $em)
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $candidacy = new Candidacy();
        $candidacy->setUserId($user);
        $candidacy->setOfferId($offer);
        $candidacy->setDateCandidacy(new \DateTimeImmutable());

        $form = $this->createForm(CandidacyType::class, $candidacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($candidacy);
            $em->flush();

            $this->addFlash('success', 'Votre candidature a été envoyée avec succès !');
            return $this->redirectToRoute('app_offer_show', ['id' => $offer->getId()]);
        }

        return $this->render('index/candidacy.html.twig', [
            'form' => $form->createView(),
            'offer' => $offer,
        ]);
    }
}
