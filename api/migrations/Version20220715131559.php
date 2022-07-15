<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715131559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE workers_services (worker_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(worker_id, service_id))');
        $this->addSql('CREATE INDEX IDX_8A93EA446B20BA36 ON workers_services (worker_id)');
        $this->addSql('CREATE INDEX IDX_8A93EA44ED5CA9E6 ON workers_services (service_id)');
        $this->addSql('ALTER TABLE workers_services ADD CONSTRAINT FK_8A93EA446B20BA36 FOREIGN KEY (worker_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE workers_services ADD CONSTRAINT FK_8A93EA44ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE users_services');
        $this->addSql('ALTER TABLE "user" ADD dtype VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_services (user_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(user_id, service_id))');
        $this->addSql('CREATE INDEX idx_873cab3ed5ca9e6 ON users_services (service_id)');
        $this->addSql('CREATE INDEX idx_873cab3a76ed395 ON users_services (user_id)');
        $this->addSql('ALTER TABLE users_services ADD CONSTRAINT fk_873cab3a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_services ADD CONSTRAINT fk_873cab3ed5ca9e6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE workers_services');
        $this->addSql('ALTER TABLE "user" DROP dtype');
    }
}
