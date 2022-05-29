<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528171558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add time to order';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE worker_available_time ADD related_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE worker_available_time ADD CONSTRAINT FK_21539BBC2B1C2395 FOREIGN KEY (related_order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_21539BBC2B1C2395 ON worker_available_time (related_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE worker_available_time DROP CONSTRAINT FK_21539BBC2B1C2395');
        $this->addSql('DROP INDEX IDX_21539BBC2B1C2395');
        $this->addSql('ALTER TABLE worker_available_time DROP related_order_id');
    }
}
