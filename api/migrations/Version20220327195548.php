<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220327195548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "order" ALTER execution_date TYPE DATE USING execution_date::date');
        $this->addSql('ALTER TABLE "order" ALTER execution_date DROP DEFAULT');
        $this->addSql('ALTER TABLE "order" ALTER execution_time TYPE TIME(0) WITHOUT TIME ZONE USING execution_time::time(0) without time zone');
        $this->addSql('ALTER TABLE "order" ALTER execution_time DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "order" ALTER execution_date TYPE VARCHAR(255) USING execution_date::varchar');
        $this->addSql('ALTER TABLE "order" ALTER execution_date DROP DEFAULT');
        $this->addSql('ALTER TABLE "order" ALTER execution_time TYPE VARCHAR(255) USING execution_time::varchar');
        $this->addSql('ALTER TABLE "order" ALTER execution_time DROP DEFAULT');
    }
}
