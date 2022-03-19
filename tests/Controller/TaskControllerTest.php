<?php
    
namespace App\Tests\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Controller\LoginTrait;


class TaskControllerTest extends WebTestCase
{
    use LoginTrait;

    private $client;

    private TaskRepository $taskRepository;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
        $this->taskRepository = self::getContainer()->get(TaskRepository::class);
    }

    public function testList() {

        $crawler = $this->client->request('GET', '/tasks');
        
        self::assertStringContainsString('Bienvenue sur Todo List', $crawler->filter('h1')->text());
    }

    public function testCreateIsSuccess() {

        $crawler = $this->client->request('GET', '/tasks/create');
        self::assertStringContainsString('Bienvenue sur Todo List', $crawler->filter('h1')->text());

    }

    public function testEditActionUser() 
    {
        $this->logAsUser();

        //$task =  $this->taskRepository->findOneBy([]);

        $crawler = $this->client->request('GET', '/tasks/' .  $task->getId() . '/edit');
        $crawler = $this->client->submitForm('Modifier', [
            "task[title]" => 'Nouveau titre',
            "task[content]"=> 'Nouveau texte'
        ]);
        
        self::assertStringContainsString('La tâche a bien été modifiée.', $crawler->filter('.alert-success')->text());

    }
    //isDone
    public function testToggleTaskAction() {
       
        $this->logAsUser();
        $crawler = $this->client->request('GET', '/tasks/112/toggle');
        
        self::assertStringContainsString("La tâche %s a bien été marquée comme faite.", "$task->getTitle()", $crawler->filter('.alert-success')->text());
    }

    //delete by admin
    public function testDeleteTaskActionByAdmin() {

        $this->logAsAdmin();
        $crawler = $this->client->request('GET', '/tasks/112/delete');
        
        self::assertStringContainsString('La tâche a bien été supprimée.', $crawler->filter('.btn-danger')->text());
    }
}