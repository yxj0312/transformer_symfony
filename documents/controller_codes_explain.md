# Code Explain

```php
<?php

declare(strict_types=1);

namespace App\Controller\Application;

use App\Domain\Application\Command\ApplicationCommand;
use App\Domain\Application\Contract\ApplicationFileUploaderInterface;
use App\Domain\Application\Exception\OnBlacklist;
use App\Domain\Application\Request\NewRequest;
use App\Form\ApplicationNewType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @see \App\Tests\Controller\Application\ApplicationControllerTest
 */
final class ApplicationController extends AbstractController
{
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    /**
     * @var ApplicationFileUploaderInterface
     */
    private $applicationFileUploader;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(MessageBusInterface $messageBus, ApplicationFileUploaderInterface $applicationFileUploader, LoggerInterface $logger)
    {
        $this->messageBus = $messageBus;
        $this->applicationFileUploader = $applicationFileUploader;
        $this->logger = $logger;
    }

    /**
     * @Route({
     *     "en": "/page/application/",
     *     "fr": "fr/page/application/"
     * }, name="application")
     */
    public function __invoke(Request $request): Response
    {
        $applicationRequest = new NewRequest();
        if ($request->query->has('email')) {
            $applicationRequest->email = $request->query->get('email', '');
        }

        $form = $this->createForm(ApplicationNewType::class, $applicationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->messageBus->dispatch(ApplicationCommand::createFromRequest(
                    $applicationRequest,
                    $this->applicationFileUploader->upload($applicationRequest->experienceApproveFile),
                    $request->attributes->getAlpha('_locale', 'en')
                ));
                return $this->redirectToRoute('application_requested');
            } catch (UniqueConstraintViolationException $uniqueConstraintViolationException) {
                $form->get('email')->addError(new FormError('The email is already in the database'));
            } catch (HandlerFailedException $handlerFailedException) {
                if ($handlerFailedException->getPrevious() instanceof OnBlacklist) {
                    return $this->redirectToRoute('on_blacklist');
                }

                throw $handlerFailedException;
                $this->logger->critical($handlerFailedException->getMessage());

                return $this->redirectToRoute('check_email');
            }
        }

        return $this->render('application/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

```

The `ApplicationController` with the `__invoke` method is typically used when defining routes in your Symfony application. When you define a route that points to this controller, Symfony will automatically invoke the `__invoke` method of the `ApplicationController` when the corresponding URL is accessed.

Let's revisit the `ApplicationController`:

```php
// src/Controller/Application/ApplicationController.php

namespace App\Controller\Application;

use App\Domain\Application\Command\ApplicationCommand;
use App\Domain\Application\Contract\ApplicationFileUploaderInterface;
use App\Domain\Application\Exception\OnBlacklist;
use App\Domain\Application\Request\NewRequest;
use App\Form\ApplicationNewType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @see \App\Tests\Controller\Application\ApplicationControllerTest
 */
final class ApplicationController extends AbstractController
{
    // ... (Constructor and other methods)

    /**
     * @Route({
     *     "en": "/page/application/",
     *     "fr": "fr/page/application/"
     * }, name="application")
     */
    public function __invoke(Request $request): Response
    {
        // ... (Controller logic for handling the application)

        return $this->render('application/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
```

In this case:

- The `__invoke` method of `ApplicationController` handles the logic for the `/page/application/` route (localized for English and French).

- When a user accesses the URL corresponding to this route, Symfony will automatically invoke the `__invoke` method.

- The controller performs actions such as creating a new `NewRequest`, handling form submissions, and dispatching a `ApplicationCommand` using the Symfony messenger component.

- Depending on the outcome of the form submission and any exceptions thrown, the controller renders the 'application/new.html.twig' template with the appropriate data.

To use the `ApplicationController`, you typically define the route in your Symfony routes configuration (e.g., `config/routes.yaml` or annotations in the controller) or in your routing configuration file.

For example, in `config/routes.yaml`:

```yaml
application:
    resource: ../src/Controller/Application
    type: annotation
```

This configuration tells Symfony to look for routes in the `App\Controller\Application` namespace and use annotations in the controllers for route definitions.

Then, in your templates or other parts of your application, you can generate URLs using the Symfony router service or Twig's `path` or `url` functions, specifying the route name, like:

```twig
{{ path('application') }}
```

This would generate the URL for the `/page/application/` route, triggering the `__invoke` method of `ApplicationController` when accessed.

Certainly! The code you provided is a Symfony controller named `ApplicationController`. It's designed to handle requests related to a new application submission. Let's break down the key aspects of this code:

### Class Overview:

- **Namespace:** The controller is in the `App\Controller\Application` namespace.

- **Class Declaration:**
  - It extends `AbstractController`, a base controller class provided by Symfony.
  - It declares strict types with `declare(strict_types=1);`.

### Constructor:

- **Dependencies:**
  - The controller has three dependencies injected through the constructor:
    - `$messageBus` (type: `MessageBusInterface`): A Symfony messenger component message bus for handling application commands.
    - `$applicationFileUploader` (type: `ApplicationFileUploaderInterface`): An interface for uploading application files.
    - `$logger` (type: `LoggerInterface`): A PSR-3 logger for logging critical messages.

### `__invoke` Method:

- **Route Annotation:**
  - The controller handles the route defined by the `@Route` annotation. It's localized with different paths for English and French.

- **Method Signature:**
  - The `__invoke` method is the main method of the controller, and it handles the incoming HTTP requests.

- **Request Handling:**
  - A new instance of `NewRequest` is created to store data from the request, particularly the email (if provided as a query parameter).

  - A form (`ApplicationNewType`) is created, representing the form used for submitting new applications. The form is then handled with the current request.

  - If the form is submitted and valid, the controller dispatches an `ApplicationCommand` using the Symfony messenger component. The command is created from the data in the request, and the application file is uploaded using the `ApplicationFileUploaderInterface`.

- **Exception Handling:**
  - The controller catches two specific exceptions:
    - `UniqueConstraintViolationException`: If a unique constraint violation occurs (e.g., duplicate email), an error is added to the form.
    - `HandlerFailedException`: If a handler in the message bus fails, it checks if the underlying exception is of type `OnBlacklist`. If so, it redirects to a route named 'on_blacklist'. Otherwise, it logs the error and redirects to a route named 'check_email'.

- **Rendering the View:**
  - The controller renders the 'application/new.html.twig' template and passes the form view to the template.

### Route Names:

- **Redirections:**
  - The controller uses `redirectToRoute` to redirect to different routes based on the outcome of the form submission or exception handling.

### Explanation of `__invoke`:

- Symfony allows controllers to implement the `__invoke` method. When a controller implements this method, Symfony treats it as a callable, allowing you to define routes without specifying an explicit action method.

In summary, this controller handles the submission of new applications, validates the form, and dispatches a command to handle the application process. It includes exception handling for specific scenarios and redirects based on the outcome. The `__invoke` method is the entry point for handling HTTP requests.