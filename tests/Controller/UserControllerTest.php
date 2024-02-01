<?php

namespace App\Test\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        // Make request
        $client->request('GET', '/user/');

        // Assert response status code
        $this->assertResponseIsSuccessful();

        // Assert response content
        $this->assertSelectorTextContains('h1', 'User index');
    }
}
