In Symfony, you can achieve similar functionality to Laravel's fillable attributes and constants in the following way:

1. **Constants:** Symfony doesn't have a direct equivalent to Laravel's `const` in the class. Instead, you can define constants in the class as usual.

2. **Fillable attributes:** Symfony uses annotations to define the properties of your entities. To achieve a similar "fillable" behavior, you can mark the properties with the `@ORM\Column` annotation.

Here's an example:

```php
// src/Entity/Role.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 * @ORM\Table(name="roles")
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDefault;

    // Constants
    public const ROLE_ADMIN = 'admin';
    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_VENDOR = 'vendor';

    // Relationships
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="role")
     */
    private $users;

    // ... (other methods)

    // Getters and setters for properties

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getIsDefault()
    {
        return $this->isDefault;
    }

    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    // ... (other methods)
}
```

In this example:

- The properties are marked with `@ORM\Column` annotations, similar to Laravel's fillable.
- The constants are defined as public constants within the class.
- Relationships (e.g., `users`) are defined using Doctrine annotations.

Remember to adjust the code based on your specific needs and Symfony version. Additionally, you may want to add validation annotations (`@Assert`) for input validation, depending on your requirements.