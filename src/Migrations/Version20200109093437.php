<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200109093437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE users ADD user_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users DROP role');
        $this->addSql('ALTER TABLE users DROP name');
        $this->addSql('ALTER TABLE users DROP adress');
        $this->addSql('ALTER TABLE users DROP password');
        $this->addSql('ALTER TABLE users DROP mail');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users ADD role VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE users ADD name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD adress VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD mail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users RENAME COLUMN user_id TO password');
    }
}
