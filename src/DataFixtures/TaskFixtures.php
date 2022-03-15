<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $users = $manager->getRepository(User::class)->findAll();

        for ($i = 0; $i < 10; $i++) {
            $user = $faker->randomElement($users);

            $task = new Task();
            $task->setTitle('Title'.$i);
            $task->setContent($faker->text());
            $task->setCreatedAt($faker->DateTime());

            $user->addTask($task);

            $manager->persist($task);
        }

        $manager->flush();
    }
}
