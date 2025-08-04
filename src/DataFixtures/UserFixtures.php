<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Ajout d'un seul Admin
        $admin = new User();
        $admin->setFirstName("jaffal");
        $admin->setLastName("imen");       
        $admin->setEmail('admin@example.com');
        $admin->setPassword($this->hasher->hashPassword($admin, 'adminpass')); // mot de passe = adminpass
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        // Ajout de 50 Apprentis
        for ($i = 0; $i < 50; $i++) {
            $apprenti = new User();
            $apprenti->setFirstName($faker->firstName('male'));            
            $apprenti->setLastName($faker->lastName());   
            $apprenti->setEmail($faker->unique()->safeEmail());
            $apprenti->setPassword($this->hasher->hashPassword($apprenti, 'password')); //mot de pass ="password" pour tous les apprentis          
            $apprenti->setRoles(['ROLE_APPRENTI']);
            $manager->persist($apprenti);
            $this->addReference('user_' . $i, $apprenti);
        }

        $manager->flush();
    }
}
