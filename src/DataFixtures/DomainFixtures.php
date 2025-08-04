<?php

namespace App\DataFixtures;

use App\Entity\Domain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DomainFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $domain1 = new Domain();
        $domain1->setName("Marketing");
        $manager->persist($domain1);
        $this->addReference('domain_marketing',$domain1);

        $domain2 = new Domain();
        $domain2->setName("Technologie");
        $manager->persist($domain2);
        $this->addReference('domain_technologie',$domain2);


        $domain3 = new Domain();
        $domain3->setName("Industrie");
        $manager->persist($domain3);
        $this->addReference('domain_industrie',$domain3);



        $domain4 = new Domain();
        $domain4->setName("Finance");
        $manager->persist($domain4);
        $this->addReference('domain_finance',$domain4);



        $domain5 = new Domain();
        $domain5->setName("Santé");
        $manager->persist($domain5);
        $this->addReference('domain_sante',$domain5);


        $manager->flush();
    }
}
