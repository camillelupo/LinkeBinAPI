<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209085538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('CREATE TABLE bin (id UUID NOT NULL, lat DOUBLE PRECISION NOT NULL, lon DOUBLE PRECISION NOT NULL, is_enable BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN bin.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE bin_historic (id UUID NOT NULL, uuid_bin_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, pickup_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, empty BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3E90161E1689261E ON bin_historic (uuid_bin_id)');
        $this->addSql('COMMENT ON COLUMN bin_historic.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN bin_historic.uuid_bin_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE city (id UUID NOT NULL, file_json JSON NOT NULL, name VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, departement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN city.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE city_bin (id UUID NOT NULL, uuid_bin_id UUID NOT NULL, uuid_city_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_871120651689261E ON city_bin (uuid_bin_id)');
        $this->addSql('CREATE INDEX IDX_87112065FEF26D93 ON city_bin (uuid_city_id)');
        $this->addSql('COMMENT ON COLUMN city_bin.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN city_bin.uuid_bin_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN city_bin.uuid_city_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE report_historic (id UUID NOT NULL, uuid_users_bin_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, degradation BOOLEAN DEFAULT NULL, bin_full BOOLEAN DEFAULT NULL, missing BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AD32762B251AC394 ON report_historic (uuid_users_bin_id)');
        $this->addSql('COMMENT ON COLUMN report_historic.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN report_historic.uuid_users_bin_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, role VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, is_enable BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users_bin (id UUID NOT NULL, uuid_bin_id UUID NOT NULL, uuid_user_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, report_full BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_99FCCDDB1689261E ON users_bin (uuid_bin_id)');
        $this->addSql('CREATE INDEX IDX_99FCCDDBD230DCA9 ON users_bin (uuid_user_id)');
        $this->addSql('COMMENT ON COLUMN users_bin.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users_bin.uuid_bin_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users_bin.uuid_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE bin_historic ADD CONSTRAINT FK_3E90161E1689261E FOREIGN KEY (uuid_bin_id) REFERENCES bin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE city_bin ADD CONSTRAINT FK_871120651689261E FOREIGN KEY (uuid_bin_id) REFERENCES bin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE city_bin ADD CONSTRAINT FK_87112065FEF26D93 FOREIGN KEY (uuid_city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE report_historic ADD CONSTRAINT FK_AD32762B251AC394 FOREIGN KEY (uuid_users_bin_id) REFERENCES users_bin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_bin ADD CONSTRAINT FK_99FCCDDB1689261E FOREIGN KEY (uuid_bin_id) REFERENCES bin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_bin ADD CONSTRAINT FK_99FCCDDBD230DCA9 FOREIGN KEY (uuid_user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bin_historic DROP CONSTRAINT FK_3E90161E1689261E');
        $this->addSql('ALTER TABLE city_bin DROP CONSTRAINT FK_871120651689261E');
        $this->addSql('ALTER TABLE users_bin DROP CONSTRAINT FK_99FCCDDB1689261E');
        $this->addSql('ALTER TABLE city_bin DROP CONSTRAINT FK_87112065FEF26D93');
        $this->addSql('ALTER TABLE users_bin DROP CONSTRAINT FK_99FCCDDBD230DCA9');
        $this->addSql('ALTER TABLE report_historic DROP CONSTRAINT FK_AD32762B251AC394');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE bin');
        $this->addSql('DROP TABLE bin_historic');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE city_bin');
        $this->addSql('DROP TABLE report_historic');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_bin');
    }
}
