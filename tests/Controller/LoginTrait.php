<?php

namespace App\Tests\Controller;

use App\Tests\Controller\LoginTrait;

trait LoginTrait
{
    private $client;
    
    public function logAsUser() 
    {
        $this->client->request('GET', '/login');

        $crawler = $this->client->submitForm('Connexion', [
            'email' => 'user.1@email.fr',
            'password' => 'password'
        ]);
        
        $crawler = $this->client->followRedirect();

        self::assertStringContainsString('Se déconnecter', $crawler->filter('.btn-danger')->text());    
    }


    public function logAsAdmin() 
    {
        $crawler = $this->client->request('GET', '/login');

        $crawler = $this->client->submitForm('Connexion', [
            'email' => 'user.0@email.fr',
            'password' => 'password'
        ]);
      
        $crawler = $this->client->followRedirect();  
        self::assertSame('Créer un utilisateur', $crawler->filter('.btn-primary')->text());
    }
    
}
