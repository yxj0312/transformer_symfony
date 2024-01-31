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

    public function testCreatedAt()
    {
        $user = new User();
        $now = new \DateTimeImmutable(); // Use DateTimeImmutable

        // Test setCreatedAt and getCreatedAt together
        $user->setCreatedAt($now);
        $this->assertEquals($now, $user->getCreatedAt());
    }
}
