<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410164628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, name VARCHAR(255) NOT NULL, path_to_photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE services_service_categories (service_id INT NOT NULL, service_category_id INT NOT NULL, PRIMARY KEY(service_id, service_category_id))');
        $this->addSql('CREATE INDEX IDX_4399B68ED5CA9E6 ON services_service_categories (service_id)');
        $this->addSql('CREATE INDEX IDX_4399B68DEDCBB4E ON services_service_categories (service_category_id)');
        $this->addSql('CREATE TABLE service_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, path_to_photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE services_service_categories ADD CONSTRAINT FK_4399B68ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE services_service_categories ADD CONSTRAINT FK_4399B68DEDCBB4E FOREIGN KEY (service_category_id) REFERENCES service_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE services_service_categories DROP CONSTRAINT FK_4399B68ED5CA9E6');
        $this->addSql('ALTER TABLE services_service_categories DROP CONSTRAINT FK_4399B68DEDCBB4E');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_category_id_seq CASCADE');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE services_service_categories');
        $this->addSql('DROP TABLE service_category');
    }
}
