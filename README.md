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

- Application
  - Builder
    - Application
  - Command
    - ApplicationCommand
    - DeleteApplicationCommand
      ...
  - Contract
    - Mailer
      - ApplicationAdminMailerInterface
    - Repository
      - ApplicationRepositoryInterface
      - ApplicationRepository
  - Exception
  - Request
    - AbstractApplicationRequest
  - Service
    - SendDailySummarization
  - ValueofObject
    - ApplicationId
    - ApprovalId
    - Birthday
    - BlacklistedId
    - ExchangePeriod
  - View
    - ApplicationEmailView
    - ApplicationInvestigateEmailView
- Account
  - ...

这种在Symfony中的项目结构看起来很有组织性，并且遵循了常见的设计和架构最佳实践，这样的结构可以提供多种优点：

模块化和可维护性：项目被按功能划分为不同的模块，每个模块都有自己的职责和功能。这种模块化的结构使得代码更易于维护，因为每个模块都可以独立开发、测试和维护。

可读性和可理解性：这种结构提供了一种直观的方式来组织代码，使得代码更易于阅读和理解。每个模块和子模块都有明确的名称和目录结构，有助于开发人员快速定位和理解代码。

分离关注点：通过将不同的功能划分为不同的模块，这种结构有助于分离关注点，每个模块只关注其特定领域的功能。这可以提高代码的可重用性和可测试性，同时降低了模块之间的耦合度。

标准化的命名约定：这种结构遵循了常见的Symfony项目结构和命名约定，这有助于提高团队协作和代码的一致性。开发人员可以更容易地理解和遵循这些约定。

抽象和接口：在这个结构中，您使用了接口和抽象类来定义契约和通用行为，这有助于实现多态性和替代性。例如，使用 ApplicationRepositoryInterface 可以轻松地切换不同的实现，而不影响其它部分的代码。

价值对象：使用值对象（Value Objects）来表示一些领域概念，这有助于确保数据的一致性和有效性。例如，ApplicationId 和 Birthday 是明确的值对象，可以封装相关逻辑。

可扩展性：这种结构为项目的扩展提供了良好的基础。新的功能可以被添加为新的模块或子模块，而不必修改现有的代码。

命令模式：将命令模式应用于命令和操作的表示（如 ApplicationCommand 和 DeleteApplicationCommand）有助于将请求与其执行者解耦，并支持撤销、排队等操作。

总之，这种结构有助于项目的可维护性、可扩展性、可读性和可测试性。它遵循了Symfony的最佳实践和常见的软件设计原则，使得项目更容易开发、维护和扩展。这种结构的优点包括良好的组织性、分离关注点、模块化设计和标准化的命名约定。

## Recipes
