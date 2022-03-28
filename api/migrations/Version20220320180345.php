<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320180345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD pathToPhoto VARCHAR(255) DEFAULT \'public/uploads/photo/dummy.jpg\'');
        $this->addSql('ALTER TABLE "user" ADD story TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ALTER is_worker SET DEFAULT false');
        $this->addSql('ALTER TABLE "user" ALTER is_client SET DEFAULT false');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP email');
        $this->addSql('ALTER TABLE "user" DROP pathToPhoto');
        $this->addSql('ALTER TABLE "user" DROP story');
        $this->addSql('ALTER TABLE "user" ALTER is_worker DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER is_client DROP DEFAULT');
    }
}
