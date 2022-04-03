<?php

namespace App\Test\Controller;


use App\Tests\Controller\LoginTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    use LoginTrait;
    private $client;
  
    public function setUp(): void
    { 
        parent::setUp();
        $this->client = self::createClient();
    }

      //Verifier la creation du user
      public function testRegister()
      {           
          $this->logAsAdmin();
  
          $this->client->request('GET', '/users/create');
          $crawler = $this->client->submitForm('Enregistrer', [
              'registration_form[username]' => 'username',
              'registration_form[email]' => 'username@gmail.com',
              'registration_form[plainPassword][first]' => 'password',
              'registration_form[plainPassword][second]' => 'password'
              
          ]);
  
          self::assertSame("Superbe ! L'utilisateur a bien été ajouté.", $crawler->filter('.alert-success')->text());
      }
  
}