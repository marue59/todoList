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

    //Verifier la creation du user
    public function testRegister()
    {           
        $this->logAsAdmin();

        $crawler = $this->client->request('GET', '/users/create');
        $crawler = $this->client->submitForm('Enregistrer', [
            'registration_form[username]' => 'username',
            'registration_form[email]' => 'username@gmail.com',
            'registration_form[plainPassword][first]' => 'password',
            'registration_form[plainPassword][second]' => 'password'
            
        ]);
        self::assertStringContainsString("L'utilisateur a bien été ajouté.", $crawler->filter('.alert-success')->text());
    }


    // Voir la liste des users si connecté en admin #[Route('/users', name: 'user_list')]
    public function testUserList()
    {
        $this->logAsAdmin();
        $crawler = $this->client->request('GET', '/admin/users');
        
        self::assertStringContainsString('Liste des utilisateurs', $crawler->filter('h1')->text());
  
    }

    // edition un user en tant qu'admin 
    public function testEditActionAdmin()
    {
        $testAdmin = $this->userRepository->findOneBy(['username'=>'johndoe2']);
        $this->assertInstanceOf(User::class, $testAdmin);
        $client->loginUser($testAdmin);

        $client->request('GET', '/users/' .  $user->getId() . '/edit');
        $this->assertResponseIsSuccessful();
    }   

    // edition un user en tant que user
    public function testEditActionUser()
    {
        $testUser = $this->userRepository->findOneBy(['username'=>'johndoe']);
        $this->assertInstanceOf(User::class, $testUser);
        $client->loginUser($testUser);

        $client->request('GET', '/users/' .  $user->getId() . '/edit');
        $this->assertResponseIsSuccessful();

    }
}