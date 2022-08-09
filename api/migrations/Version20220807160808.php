<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220807160808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE worker_service ALTER price DROP NOT NULL');
        $this->addSql('ALTER TABLE worker_service ALTER duration DROP NOT NULL');
        $this->addSql('ALTER TABLE worker_service ALTER description DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE worker_service ALTER price SET NOT NULL');
        $this->addSql('ALTER TABLE worker_service ALTER duration SET NOT NULL');
        $this->addSql('ALTER TABLE worker_service ALTER description SET NOT NULL');
    }
}
