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

    //Edition d'un tache en tant que user
    public function testEditActionUser() 
    {
        $task = $this->taskRepository->findOneBy([]);
        $this->logAsUser();

        $crawler = $this->client->request('POST', '/tasks/' .  $task->getId() . '/edit');
        
        $crawler = $this->client->selectButton('Modifier')->form( [
            "task[title]" => 'Nouveau titre',
            "task[content]"=> 'Nouveau texte'
        ]);
        $this->client->submit($form);
        $this->assertSelectorTextContains('.alert-success', "La tâche a bien été modifiée.");

    }
    //isDone
    public function testToggleTaskAction() {
       
        $this->logAsUser();
        $crawler = $this->client->request('GET', '/tasks/' .  $task->getId() . '/toggle');
        
        self::assertStringContainsString("La tâche %s a bien été marquée comme faite.", "$task->getTitle()", $crawler->filter('.alert-success')->text());
    }

    //delete by admin
    public function testDeleteTaskActionByAdmin() {
        
        $user = $this->userRepository->find(1);
        $this->logAsAdmin($this->client, $user);

        $crawler = $this->client->request('GET', '/tasks/' .  $user->getId() . '/delete');
        
        self::assertStringContainsString('La tâche a bien été supprimée.', $crawler->filter('.btn-danger')->text());
    }
}