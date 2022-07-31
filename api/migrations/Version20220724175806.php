<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220724175806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE worker_service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE worker_service (id INT NOT NULL, worker_id INT NOT NULL, service_id INT NOT NULL, price INT NOT NULL, duration SMALLINT NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D572E19F6B20BA36 ON worker_service (worker_id)');
        $this->addSql('CREATE INDEX IDX_D572E19FED5CA9E6 ON worker_service (service_id)');
        $this->addSql('ALTER TABLE worker_service ADD CONSTRAINT FK_D572E19F6B20BA36 FOREIGN KEY (worker_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE worker_service ADD CONSTRAINT FK_D572E19FED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE workers_services');
        $this->addSql('ALTER TABLE service DROP price');
        $this->addSql('ALTER TABLE service DROP duration');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398ED5CA9E6');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398ED5CA9E6 FOREIGN KEY (service_id) REFERENCES worker_service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE worker_service_id_seq CASCADE');
        $this->addSql('CREATE TABLE workers_services (worker_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(worker_id, service_id))');
        $this->addSql('CREATE INDEX idx_8a93ea44ed5ca9e6 ON workers_services (service_id)');
        $this->addSql('CREATE INDEX idx_8a93ea446b20ba36 ON workers_services (worker_id)');
        $this->addSql('ALTER TABLE workers_services ADD CONSTRAINT fk_8a93ea446b20ba36 FOREIGN KEY (worker_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE workers_services ADD CONSTRAINT fk_8a93ea44ed5ca9e6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT fk_f5299398ed5ca9e6');
        $this->addSql('DROP TABLE worker_service');
        $this->addSql('ALTER TABLE service ADD price SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD duration SMALLINT DEFAULT NULL');
    }
}
