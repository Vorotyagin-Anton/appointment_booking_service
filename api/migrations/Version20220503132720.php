<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503132720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create worker_available_time table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE worker_available_time_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE worker_available_time (id INT NOT NULL, worker_id INT NOT NULL, exact_time_in_minutes INT NOT NULL, is_time_free BOOLEAN NOT NULL DEFAULT true, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_21539BBC6B20BA36 ON worker_available_time (worker_id)');
        $this->addSql('ALTER TABLE worker_available_time ADD CONSTRAINT FK_21539BBC6B20BA36 FOREIGN KEY (worker_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE worker_available_time_id_seq CASCADE');
        $this->addSql('DROP TABLE worker_available_time');
    }
}
