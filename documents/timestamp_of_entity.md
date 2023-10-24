If you want to create a `created_at` and `updated_at` timestamp fields similar to Laravel's convention in Symfony, you can achieve this using Doctrine, Symfony's Object-Relational Mapping (ORM) system. Symfony doesn't have built-in methods like Laravel's `timestamps()`, so you'll need to manually define these fields in your Entity class.

Here's how you can do it:

1. In your Symfony Entity class, add the following properties and annotations to represent the `created_at` and `updated_at` fields. This assumes that your Entity class has other properties as well:

```php
// src/Entity/YourEntity.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="your_table_name")
 */
class YourEntity
{
    // ...

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    // ...

    // Getters and setters for the createdAt and updatedAt properties
    // ...

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    // ...
}
```

2. Next, you can use Doctrine's event listeners to automatically update the `created_at` and `updated_at` timestamps when an entity is created or updated. To do this, you'll create a custom Doctrine Event Listener. You can create a service for this listener in your Symfony configuration.

```yaml
# config/services.yaml

services:
    App\EventListener\TimestampListener:
        tags:
            - { name: doctrine.event_listener, event: prePersist }
            - { name: doctrine.event_listener, event: preUpdate }
```

3. Create the event listener class. This listener will update the timestamps automatically before an entity is persisted (created or updated):

```php
// src/EventListener/TimestampListener.php

namespace App\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\Entity\YourEntity;

class TimestampListener
{
    public function prePersist(YourEntity $entity, LifecycleEventArgs $event): void
    {
        $entity->setCreatedAt(new \DateTime());
        $entity->setUpdatedAt(new \DateTime());
    }

    public function preUpdate(YourEntity $entity, LifecycleEventArgs $event): void
    {
        $entity->setUpdatedAt(new \DateTime());
    }
}
```

Now, whenever you create or update an entity of the `YourEntity` class, the `created_at` and `updated_at` timestamps will be automatically updated. This mimics the behavior of Laravel's timestamps.