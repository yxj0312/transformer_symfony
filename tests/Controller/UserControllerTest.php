<?php

namespace App\Test\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private UserRepository $repository;
    private string $path = '/user/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(User::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'user[name]' => 'Testing',
            'user[email]' => 'Testing',
            'user[password]' => 'Testing',
            'user[role_id]' => 'Testing',
            'user[first_name]' => 'Testing',
            'user[last_name]' => 'Testing',
            'user[phone]' => 'Testing',
            'user[date_of_birth]' => 'Testing',
            'user[is_verified]' => 'Testing',
            'user[password_reset_token]' => 'Testing',
            'user[verification_token]' => 'Testing',
            'user[created_at]' => 'Testing',
            'user[updated_at]' => 'Testing',
        ]);

        self::assertResponseRedirects('/user/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setPassword('My Title');
        $fixture->setRole_id('My Title');
        $fixture->setFirst_name('My Title');
        $fixture->setLast_name('My Title');
        $fixture->setPhone('My Title');
        $fixture->setDate_of_birth('My Title');
        $fixture->setIs_verified('My Title');
        $fixture->setPassword_reset_token('My Title');
        $fixture->setVerification_token('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setUpdated_at('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setPassword('My Title');
        $fixture->setRole_id('My Title');
        $fixture->setFirst_name('My Title');
        $fixture->setLast_name('My Title');
        $fixture->setPhone('My Title');
        $fixture->setDate_of_birth('My Title');
        $fixture->setIs_verified('My Title');
        $fixture->setPassword_reset_token('My Title');
        $fixture->setVerification_token('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setUpdated_at('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'user[name]' => 'Something New',
            'user[email]' => 'Something New',
            'user[password]' => 'Something New',
            'user[role_id]' => 'Something New',
            'user[first_name]' => 'Something New',
            'user[last_name]' => 'Something New',
            'user[phone]' => 'Something New',
            'user[date_of_birth]' => 'Something New',
            'user[is_verified]' => 'Something New',
            'user[password_reset_token]' => 'Something New',
            'user[verification_token]' => 'Something New',
            'user[created_at]' => 'Something New',
            'user[updated_at]' => 'Something New',
        ]);

        self::assertResponseRedirects('/user/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getPassword());
        self::assertSame('Something New', $fixture[0]->getRole_id());
        self::assertSame('Something New', $fixture[0]->getFirst_name());
        self::assertSame('Something New', $fixture[0]->getLast_name());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getDate_of_birth());
        self::assertSame('Something New', $fixture[0]->getIs_verified());
        self::assertSame('Something New', $fixture[0]->getPassword_reset_token());
        self::assertSame('Something New', $fixture[0]->getVerification_token());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
        self::assertSame('Something New', $fixture[0]->getUpdated_at());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new User();
        $fixture->setName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setPassword('My Title');
        $fixture->setRole_id('My Title');
        $fixture->setFirst_name('My Title');
        $fixture->setLast_name('My Title');
        $fixture->setPhone('My Title');
        $fixture->setDate_of_birth('My Title');
        $fixture->setIs_verified('My Title');
        $fixture->setPassword_reset_token('My Title');
        $fixture->setVerification_token('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setUpdated_at('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/user/');
    }
}
