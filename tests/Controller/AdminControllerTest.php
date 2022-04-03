<?php

namespace App\Test\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\Controller\LoginTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{   
    use LoginTrait;

    private $client;
    
    private UserRepository $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
        $this->userRepository = self::getContainer()->get(UserRepository::class);
    }


    // Voir la liste des users si connecté en admin #[Route('/users', name: 'user_list')]
    public function testUserList()
    {
        $this->logAsAdmin();
        $crawler = $this->client->request('GET', '/admin/users');
        
        self::assertStringContainsString('Liste des utilisateurs', $crawler->filter('h1')->text());
  
    }


    // edition un user en tant que user
    public function testEditActionUser()
    {
        $this->logAsAdmin();
        $user = $this->userRepository->findOneBy(['email'=> 'user.2@email.fr']);
       
        $this->client->request('GET', '/admin/users/' .  $user->getId() . '/edit');

        $crawler = $this->client->submitForm('Modifier', [
            'registration_form[username]' => 'username',
            'registration_form[plainPassword][first]' => 'password',
            'registration_form[plainPassword][second]' => 'password'
        ]);
       
        $crawler = $this->client->followRedirect(); 
        self::assertStringContainsString("L'utilisateur a bien été modifié", $crawler->filter('.alert-success')->text());

    }
}