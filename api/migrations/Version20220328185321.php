<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328185321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX IDX_F5299398F55397E8 ON "order" (client_user_id)');
        $this->addSql('CREATE INDEX IDX_F52993989381A8D8 ON "order" (worker_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_F5299398F55397E8');
        $this->addSql('DROP INDEX IDX_F52993989381A8D8');
    }
}
