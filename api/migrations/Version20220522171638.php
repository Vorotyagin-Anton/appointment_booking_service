<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220522171638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add career';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE career_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE career (id INT NOT NULL, worker_id INT NOT NULL, year_from DATE DEFAULT NULL, year_to DATE DEFAULT NULL, speciality VARCHAR(255) NOT NULL, place VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B25B6C846B20BA36 ON career (worker_id)');
        $this->addSql('ALTER TABLE career ADD CONSTRAINT FK_B25B6C846B20BA36 FOREIGN KEY (worker_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE career_id_seq CASCADE');
        $this->addSql('DROP TABLE career');
    }
}
