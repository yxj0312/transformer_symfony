Setting up PHPUnit in Symfony for testing with SQLite in a development environment and MySQL in a production environment is a common practice. Here's a step-by-step guide:

**Step 1: Install PHPUnit**

Make sure you have PHPUnit installed. You can install PHPUnit globally or use it as a project dependency.

```bash
composer require --dev phpunit/phpunit
```

**Step 2: Configure Symfony's `.env` Files**

Symfony uses environment files (`.env`, `.env.test`, etc.) to configure different environments. In your `.env.test` file, set the database configuration to use SQLite. You can create a separate SQLite database file for testing:

```env
# .env.test
DATABASE_URL=sqlite:///%kernel.project_dir%/var/test.db
```

**Step 3: Configure `config/packages/test/doctrine.yaml`**

Symfony uses different configuration files for different environments. Create a `config/packages/test/doctrine.yaml` file to specify the test database configuration:

```yaml
# config/packages/test/doctrine.yaml
doctrine:
    dbal:
        url: '%env(resolve:DATABASE_URL)%'
```

This configuration file tells Symfony to resolve the `DATABASE_URL` environment variable from your `.env.test` file.

**Step 4: Create the Test Database**

Run the following command to create the test database and schema:

```bash
php bin/console doctrine:database:create --env=test
php bin/console doctrine:schema:create --env=test
```

**Step 5: Write PHPUnit Tests**

Now, you can write PHPUnit tests for your Symfony application using the SQLite database in your testing environment.

**Step 6: Running Tests**

You can run your tests using PHPUnit:

```bash
php bin/phpunit
```

PHPUnit will use the configuration from the `.env.test` file and the `doctrine.yaml` file in the `test` environment configuration.

**Switching to MySQL for Production**

In your production environment (`.env.prod`), configure the `DATABASE_URL` to use your MySQL database:

```env
# .env.prod
DATABASE_URL=mysql://username:password@localhost:3306/your_database
```

When deploying your application to a production environment, make sure to use the `.env.prod` file. Symfony will use the MySQL database configuration for the production environment.

With this setup, your tests will use the SQLite database for testing, and your production environment will use MySQL, as desired.

Please note that the exact file paths and configurations may vary based on your Symfony version and project structure. Be sure to adapt the instructions accordingly.