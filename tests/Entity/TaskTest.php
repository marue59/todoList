<?php
    
namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Task;


class TaskTest extends WebTestCase {
    
    private Task $task;

    public function setUp(): void {

        $this->task = new Task();
        $this->task->setTitle('Task Title');
        $this->task->setContent('Task Content');
    }


    public function testTitle() {
        
        self::assertSame($this->task->getTitle(), 'Task Title');
    }

    public function testContent() {
        
        self::assertSame($this->task->getContent(), 'Task Content');
    }

}