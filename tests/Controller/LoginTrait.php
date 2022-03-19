<?php

namespace App\Tests\Controller;

trait LoginTrait
{
    private $client;
    
    public function logAsUser() 
    {
        $crawler = $this->client->request('GET', '/login');

        $crawler = $this->client->submitForm('Connexion', [
            'email' => 'user.1@email.fr',
            'password' => 'password'
        ]);

        self::assertStringContainsString('Se déconnecter', $crawler->filter('.btn-danger')->text());
    }


    public function logAsAdmin() 
    {
        $crawler = $this->client->request('GET', '/login');

        $crawler = $this->client->submitForm('Connexion', [
            'email' => 'user.0@email.fr',
            'password' => 'admin'
        ]);

        self::assertStringContainsString('Se déconnecter', $crawler->filter('.btn-danger')->text());
    }
    
}
