<?php
    
namespace App\Tests\Controller;

use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use App\Tests\Controller\LoginTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TaskControllerTest extends WebTestCase
{
    use LoginTrait;

    private $client;

    private TaskRepository $taskRepository;
    private UserRepository $userkRepository;

    
    public function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
        $this->taskRepository = self::getContainer()->get(TaskRepository::class);
        $this->userRepository = self::getContainer()->get(UserRepository::class);
    }

    public function testList() {

        $crawler = $this->client->request('GET', '/tasks');
        
        self::assertStringContainsString('Bienvenue sur Todo List', $crawler->filter('h1')->text());
    }

    public function testCreateIsSuccess() {

        $crawler = $this->client->request('GET', '/tasks/create');
        self::assertStringContainsString('Bienvenue sur Todo List', $crawler->filter('h1')->text());

    }

    //Edition d'un tache en tant que admin
    public function testEditActionAdmin() 
    {
        $task = $this->taskRepository->findOneBy([]);
        $this->logAsAdmin();

        $crawler = $this->client->request('GET', '/tasks/' .  $task->getId() . '/edit');
        
        $crawler = $this->client->submitForm('Modifier', [
            "task[title]" => 'Nouveau titre',
            "task[content]"=> 'Nouveau texte'
        ]);

        $crawler = $this->client->followRedirect();
        $this->assertSelectorTextContains('.alert-success', "La tâche a bien été modifiée.");

    }
    //isDone
    public function testToggleTaskAction() {

        $task = $this->taskRepository->findOneBy([]);
        $this->logAsAdmin();
        $crawler = $this->client->request('GET', '/tasks/' .  $task->getId() . '/toggle');

        $crawler = $this->client->followRedirect(); 
        self::assertStringContainsString("Le statut a été changé", $crawler->filter('.alert-success')->text());
    }

    //delete by admin
    public function testDeleteTaskActionByAdmin() {
        
        $task = $this->taskRepository->findOneBy([]);
        $this->logAsAdmin();

        $crawler = $this->client->request('GET', '/tasks/' .  $task->getId() . '/delete');
       
        $crawler = $this->client->followRedirect(); 
        self::assertStringContainsString('La tâche a bien été supprimée.', $crawler->filter('.alert-success')->text());
    }
}