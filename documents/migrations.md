Sure, here's a basic example of using Doctrine Migrations in Symfony to create a simple database table.

Suppose you have an entity called `Product` that you want to store in the database. You'll need to create a migration to create the corresponding database table.

1. First, make sure you have the `doctrine/doctrine-migrations-bundle` package installed, as I mentioned earlier.

2. Generate a Migration:
   Use the Symfony console to generate a new migration:

   ```bash
   bin/console make:migration
   ```

   This command will generate a new migration file in the `src/Migrations` directory.

3. Modify the Migration:
   Open the generated migration file (e.g., `VersionXXXXXXXXXXXXXX.php`) and add the necessary code to create the `Product` table using Doctrine's Schema Definition Language (DBAL).

   Here's an example migration that creates a `Product` table:

   ```php
   // src/Migrations/VersionXXXXXXXXXXXXXX.php

   use Doctrine\DBAL\Schema\Schema;
   use Doctrine\Migrations\AbstractMigration;

   final class VersionXXXXXXXXXXXXXX extends AbstractMigration
   {
       public function up(Schema $schema): void
       {
           $table = $schema->createTable('product');
           $table->addColumn('id', 'integer', ['autoincrement' => true]);
           $table->addColumn('name', 'string', ['length' => 255]);
           $table->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2]);
           $table->setPrimaryKey(['id']);
       }

       public function down(Schema $schema): void
       {
           $schema->dropTable('product');
       }
   }
   ```

   In this migration, we create a table named `product` with columns for `id`, `name`, and `price`.

4. Apply the Migration:
   Run the following command to execute the migration and create the `product` table:

   ```bash
   bin/console doctrine:migrations:migrate
   ```

   Symfony will execute the migration, and the `product` table will be created in your database.

That's a basic example of using Doctrine Migrations in Symfony to manage database schema changes. You can follow a similar process to create more complex migrations and manage your database schema over time.