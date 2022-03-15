<?php
    
namespace App\Tests\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TaskControllerTest extends WebTestCase
{
    private $client;

    private TaskRepository $taskRepository;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
        $this->taskRepository = self::getContainer()->get(TaskRepository::class);
    }

    public function logAs() {

        $crawler = $this->client->request('GET', '/login');

        $crawler = $this->client->submitForm('Sign in', [
            'email' => 'test@gmail.com',
            'password' => 'test'
        ]);

        self::assertStringContainsString('Se déconnecter', $crawler->filter('a')->text());
    }

    public function testList() {

        $crawler = $this->client->request('GET', '/tasks');
        
        self::assertStringContainsString('Bienvenue sur Todo List', $crawler->filter('h1')->text());
    }

    public function testCreate() {

        $crawler = $this->client->request('GET', '/tasks/create');
        self::assertStringContainsString('Bienvenue sur Todo List', $crawler->filter('h1')->text());


    }
/*
    public function testEdit() {
        $this->logAs();

    }
*/
}
