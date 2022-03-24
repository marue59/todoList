<?php
    
namespace App\Tests\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UserTest extends WebTestCase {
    
    private User $user;

    public function setUp(): void {

        $this->user = new User();

        $this->user->setUsername('username');        
        $this->user->setEmail('email@email.fr');
        $this->user->setRoles(['ROLE_USER']);
        $this->user->setPassword('password');
   }

    public function testUsername() {
        
        self::assertSame($this->user->getUsername(), 'username');
    }
    public function testEmail() {
        
        self::assertSame($this->user->getEmail(), 'email@email.fr');
    }
    public function testRoles() {
        
        self::assertSame($this->user->getRoles(), ['ROLE_USER']);
    }
    public function testPassword() {
        
        self::assertSame($this->user->getPassword(), 'password');
    }

}