<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220522164718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add rating';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE rating_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rating (id INT NOT NULL, worker_id INT NOT NULL, score INT DEFAULT NULL, voices INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D88926226B20BA36 ON rating (worker_id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926226B20BA36 FOREIGN KEY (worker_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" DROP rating');
        $this->addSql('ALTER TABLE "user" DROP popularity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE rating_id_seq CASCADE');
        $this->addSql('DROP TABLE rating');
        $this->addSql('ALTER TABLE "user" ADD rating SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD popularity SMALLINT DEFAULT NULL');
    }
}
