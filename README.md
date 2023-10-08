<https://symfony.com/doc/current/best_practices.html>

your_project/
├─ assets/
├─ bin/
│  └─ console
├─ config/
│  ├─ packages/
│  └─ services.yaml
├─ migrations/
├─ public/
│  ├─ build/
│  └─ index.php
├─ src/
│  ├─ Kernel.php
│  ├─ Command/
│  ├─ Controller/
│  ├─ DataFixtures/
│  ├─ Entity/
│  ├─ EventSubscriber/
│  ├─ Form/
│  ├─ Repository/
│  ├─ Security/
│  └─ Twig/
├─ templates/
├─ tests/
├─ translations/
├─ var/
│  ├─ cache/
│  └─ log/
└─ vendor/

Repository
    DoctrineAccountRepository AccountRepositoryInterface
    DoctrineActivityRepository ActivityRepositoryInterface
Domain
    Account
        Contract
            Repository
                AccountRepositoryInterface

```php
interface ApplicationRepositoryInterface {
    public function save(Application $application): void;

    public function findAllForApproval(): Query;

     /**
     * @throws ApplicationNotFound
     */
    public function findById(ApplicationId $applicationId): Application;
}

final class DoctrineApplicationRepository implements ApplicationRepositoryInterface {*
    /**
     * @var EntityRepository<Application>
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Application::class);
        $this->entityManager = $entityManager;
    }

    public function save(Application $application): void
    {
        $this->entityManager->persist($application);
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}
```

The Repository pattern is a design pattern that separates the application's data access layer from the rest of the application. It provides a way to access data stored in a database or other persistence mechanism, without exposing the underlying data storage implementation to the rest of the application.

In the context of the DoctrineApplicationRepository class, it is likely that this class is responsible for handling the persistence of Application entities using the Doctrine ORM. The class likely provides methods for querying, creating, updating, and deleting Application entities in the database.

By using the Repository pattern, the application can abstract away the details of how the data is stored and retrieved, allowing for easier maintenance and testing of the application. Additionally, it allows for the application to switch out the underlying data storage implementation without affecting the rest of the application's code.

yxj0312
can u give an example

GitHub Copilot
Sure! Here's an example of how you might use the DoctrineApplicationRepository class in a PHP project:

In this example, we first instantiate the DoctrineEntityManager and pass it to the DoctrineApplicationRepository constructor. We then create a new Application entity, set its properties, and save it to the database using the save method of the DoctrineApplicationRepository. We then retrieve the Application entity by ID, update its description, and save the changes to the database. Finally, we delete the Application entity from the database using the delete method of the DoctrineApplicationRepository.

```php
// Instantiate the Doctrine EntityManager
$entityManager = EntityManager::create($connectionParams, $config);

// Instantiate the DoctrineApplicationRepository, passing in the EntityManager
$applicationRepository = new DoctrineApplicationRepository($entityManager);

// Create a new Application entity
$application = new Application();
$application->setName('My Application');
$application->setDescription('This is my application.');

// Save the new Application entity to the database
$applicationRepository->save($application);

// Retrieve an existing Application entity by ID
$applicationId = 1;
$application = $applicationRepository->findById($applicationId);

// Update the retrieved Application entity
$application->setDescription('This is my updated application.');

// Save the updated Application entity to the database
$applicationRepository->save($application);

// Delete the Application entity from the database
$applicationRepository->delete($application);
```

Application
Builder
    Application
Command
    ApplicationCommand
    DeleteApplicationCommand
    ...
Contract
    Mailer
        ApplicationAdminMailerInterface
    Repository
        ApplicationRepositoryInterface  // ApplicationRepository
Exception
Request
    AbstractApplicationRequest
Service
    SendDailySummarization
ValueofObject
    ApplicationId
    ApprovalId
    Birthday
    BlacklistedId
    ExchangePeriod
View
    ApplicationEmailView
    ApplicationInvestigateEmailView

## Recipes
