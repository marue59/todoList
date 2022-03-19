<?php

namespace App\Test\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private $client;
    private UserRepository $userRepository;
  
    public function setUp(): void
    { 
        parent::setUp();
        $this->client = self::createClient();
        $this->userRepository = self::getContainer()->get(UserRepository::class);

    }
    //Vérifier que le code status de la réponse HTTP est bien 200.
    public function testHomepageIsUp()
    {
        $this->client->request('GET', '/');
        
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    }
}