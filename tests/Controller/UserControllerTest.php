<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private $client;
  
    public function setUp(): void
    { 
        
        $this->client = self::createClient();
    }
    //Vérifier que le code status de la réponse HTTP est bien 200.
    public function testHomepageIsUp()
    {
        
        $client->request('GET', '/');
        
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}