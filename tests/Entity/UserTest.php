<?php
    
namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UserTest extends WebTestCase {
    
    private User $user;

    public function setUp(): void {

        $this->user = new User();
        $this->user->setUsername('username');        
        $this->user->setEmail('email@email.fr');
        $this->user->setRoles('Role_User');
        $this->user->setPassword('password');
        $this->user->setIsVerified('false');
        //$this->user->addTask();
    }
    public function testUsername() {
        
        self::assertSame($this->task->getUsername(), 'username');
    }

}