<?php

namespace App\Test\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ProductRepository $repository;
    private string $path = '/product/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Product::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Product index');

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
            'product[name]' => 'Testing',
            'product[description]' => 'Testing',
            'product[price]' => 'Testing',
            'product[quantity]' => 'Testing',
            'product[image]' => 'Testing',
            'product[is_featured]' => 'Testing',
            'product[is_active]' => 'Testing',
            'product[meta_title]' => 'Testing',
            'product[meta_description]' => 'Testing',
            'product[slug]' => 'Testing',
            'product[feature_image]' => 'Testing',
        ]);

        self::assertResponseRedirects('/product/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Product();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setPrice('My Title');
        $fixture->setQuantity('My Title');
        $fixture->setImage('My Title');
        $fixture->setIs_featured('My Title');
        $fixture->setIs_active('My Title');
        $fixture->setMeta_title('My Title');
        $fixture->setMeta_description('My Title');
        $fixture->setSlug('My Title');
        $fixture->setFeature_image('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Product');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Product();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setPrice('My Title');
        $fixture->setQuantity('My Title');
        $fixture->setImage('My Title');
        $fixture->setIs_featured('My Title');
        $fixture->setIs_active('My Title');
        $fixture->setMeta_title('My Title');
        $fixture->setMeta_description('My Title');
        $fixture->setSlug('My Title');
        $fixture->setFeature_image('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'product[name]' => 'Something New',
            'product[description]' => 'Something New',
            'product[price]' => 'Something New',
            'product[quantity]' => 'Something New',
            'product[image]' => 'Something New',
            'product[is_featured]' => 'Something New',
            'product[is_active]' => 'Something New',
            'product[meta_title]' => 'Something New',
            'product[meta_description]' => 'Something New',
            'product[slug]' => 'Something New',
            'product[feature_image]' => 'Something New',
        ]);

        self::assertResponseRedirects('/product/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getPrice());
        self::assertSame('Something New', $fixture[0]->getQuantity());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getIs_featured());
        self::assertSame('Something New', $fixture[0]->getIs_active());
        self::assertSame('Something New', $fixture[0]->getMeta_title());
        self::assertSame('Something New', $fixture[0]->getMeta_description());
        self::assertSame('Something New', $fixture[0]->getSlug());
        self::assertSame('Something New', $fixture[0]->getFeature_image());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Product();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setPrice('My Title');
        $fixture->setQuantity('My Title');
        $fixture->setImage('My Title');
        $fixture->setIs_featured('My Title');
        $fixture->setIs_active('My Title');
        $fixture->setMeta_title('My Title');
        $fixture->setMeta_description('My Title');
        $fixture->setSlug('My Title');
        $fixture->setFeature_image('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/product/');
    }
}
