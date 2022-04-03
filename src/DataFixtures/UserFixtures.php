<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @codeCoverageIgnore
 */
class UserFixtures extends Fixture
{   
    /**
     * @var UserPasswordHasherInterface
     */
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager): void
    {  
        $faker = Factory::create('fr_FR');
    
        
        for ($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->setEmail("user.$i@email.fr");
            $user->setRoles(["ROLE_USER"]);
            $user->setPassword($this->encoder->hashPassword($user, 'password'));
            $user->setUsername($faker->firstname());
            $user->setIsVerified(0);

            if ($i == 0) {
                $user->setRoles(['ROLE_ADMIN']);
            }

            $manager->persist($user);
        }

        $manager->flush();
    }
}
