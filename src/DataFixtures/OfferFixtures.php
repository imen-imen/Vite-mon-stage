<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\DomainFixtures;

class OfferFixtures extends Fixture implements DependentFixtureInterface {
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // on recupere les domaines crees dans domainfixtures
                $domainKeys = [
            'domain_marketing',
            'domain_technologie',
            'domain_industrie',
            'domain_finance',
            'domain_sante'
        ];
 for ($i = 0; $i < 50; $i++) {
            $offer = new Offer();
            $offer->setTitle($faker->jobTitle());            
            $offer->setDescription($faker->paragraph(5));   
            $offer->setLocalisation($faker->City());
            $offer->setStartDate(new \DateTimeImmutable($faker->dateTimeBetween('now', '+3 months')->format('Y-m-d')));
            $offer->setDuration($faker->numberBetween(30, 180)); //entre 1 et 6 mois en jours
            $offer->setCreatedAt(new \DateTimeImmutable('-3 months'));   
            // POur faire le FK du domaine 
            $randomKey = $faker->randomElement($domainKeys);
            $domain = $this->getReference($randomKey, \App\Entity\Domain::class);
            $offer->setDomain($domain);

            $manager->persist($offer);
                $this->addReference('offer_' . $i, $offer);
        }

        $manager->flush();
    }

    // Pour Indiquer qu’on dépend de DomainFixtures
    public function getDependencies(): array
    {
        return [
            DomainFixtures::class,
        ];
    }
}