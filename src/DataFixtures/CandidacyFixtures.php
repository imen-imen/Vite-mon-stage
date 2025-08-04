<?php

namespace App\DataFixtures;

use App\Entity\Candidacy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CandidacyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // On crée 100 candidatures (aléatoires entre users et offres)
        for ($i = 0; $i < 100; $i++) {
            $candidacy = new Candidacy();

            $candidacy->setMessage($faker->optional()->paragraph(2));
            $candidacy->setDateCandidacy(new \DateTimeImmutable($faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d')));

            // Choisir un apprenti et une offre aléatoires
            $userIndex = $faker->numberBetween(0, 49);
            $offerIndex = $faker->numberBetween(0, 49);

            $user = $this->getReference('user_' . $userIndex, \App\Entity\User::class);
            $offer = $this->getReference('offer_' . $offerIndex, \App\Entity\Offer::class);


            $candidacy->setUserId($user);
            $candidacy->setOfferId($offer);

            $manager->persist($candidacy);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            OfferFixtures::class,
        ];
    }
}
