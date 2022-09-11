<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220911184202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE contact_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contact_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE order_status (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "order" ADD client_contact_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" DROP client_contact_type');
        $this->addSql('ALTER TABLE "order" DROP status');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993982245F0E1 FOREIGN KEY (client_contact_type_id) REFERENCES contact_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993986BF700BD FOREIGN KEY (status_id) REFERENCES order_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398ED5CA9E6 FOREIGN KEY (service_id) REFERENCES worker_service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F52993982245F0E1 ON "order" (client_contact_type_id)');
        $this->addSql('CREATE INDEX IDX_F52993986BF700BD ON "order" (status_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993982245F0E1');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993986BF700BD');
        $this->addSql('DROP SEQUENCE contact_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE order_status_id_seq CASCADE');
        $this->addSql('DROP TABLE contact_type');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398ED5CA9E6');
        $this->addSql('DROP INDEX IDX_F52993982245F0E1');
        $this->addSql('DROP INDEX IDX_F52993986BF700BD');
        $this->addSql('ALTER TABLE "order" ADD client_contact_type INT NOT NULL');
        $this->addSql('ALTER TABLE "order" ADD status INT NOT NULL');
        $this->addSql('ALTER TABLE "order" DROP client_contact_type_id');
        $this->addSql('ALTER TABLE "order" DROP status_id');
    }
}
