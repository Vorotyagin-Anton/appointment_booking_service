<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410183315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_services (user_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(user_id, service_id))');
        $this->addSql('CREATE INDEX IDX_873CAB3A76ED395 ON users_services (user_id)');
        $this->addSql('CREATE INDEX IDX_873CAB3ED5CA9E6 ON users_services (service_id)');
        $this->addSql('ALTER TABLE users_services ADD CONSTRAINT FK_873CAB3A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_services ADD CONSTRAINT FK_873CAB3ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users_services');
    }
}
