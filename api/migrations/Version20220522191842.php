<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220522191842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add price and duration to service';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service ADD price SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD duration SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP price');
        $this->addSql('ALTER TABLE service DROP duration');
    }
}
