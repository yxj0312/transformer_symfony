<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231013201141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
       $table = $schema->createTable('users');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('email', 'string', ['length' => 255]);
        $table->addColumn('password', 'string', ['length' => 255]);
        $table->addColumn('role_id', 'integer');
        $table->addColumn('remember_token', 'string', ['length' => 100, 'notnull' => false]);
        $table->addColumn('created_at', 'datetime', ['notnull' => false]);
        $table->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $table->addColumn('deleted_at', 'datetime', ['notnull' => false]);

        // Additional attributes for online shopping platform
        $table->addColumn('first_name', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('last_name', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('phone', 'string', ['length' => 20, 'notnull' => false]);
        $table->addColumn('date_of_birth', 'date', ['notnull' => false]);
        $table->addColumn('is_verified', 'boolean', ['default' => false]);
        $table->addColumn('verification_token', 'string', ['length' => 255, 'notnull' => false]);

        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['email'], 'UNIQ_Users_email');
        $table->addForeignKeyConstraint('roles', ['role_id'], ['id'], [], 'FK_Users_Roles');

        $table->addOption('charset', 'utf8');
        $table->addOption('collate', 'utf8_unicode_ci');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
