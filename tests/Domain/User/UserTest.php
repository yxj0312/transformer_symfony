<?php

namespace App\Tests\Domain\User;

use App\Entity\User;

class UserTest extends \PHPUnit\Framework\TestCase
{
    public function testGetName()
    {
        $user = new User();
        $user->setName('John Doe');
        
        $this->assertEquals('John Doe', $user->getName());
    }
    
    public function testSetName()
    {
        $user = new User();
        $user->setName('John Doe');
        
        $this->assertEquals('John Doe', $user->getName());
    }
    
    public function testGetCreatedAt()
    {
        $user = new User();
        $now = new \DateTime();
        $user->setCreatedAt($now);
        
        $this->assertEquals($now, $user->getCreatedAt());
    }
    
    public function testSetCreatedAt()
    {
        $user = new User();
        $now = new \DateTime();
        $user->setCreatedAt($now);
        
        $this->assertEquals($now, $user->getCreatedAt());
    }

}