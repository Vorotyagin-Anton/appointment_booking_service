<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528171023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'refactor order';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX idx_f52993989381a8d8');
        $this->addSql('DROP INDEX idx_f5299398f55397e8');
        $this->addSql('ALTER TABLE "order" ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE "order" ADD worker_id INT NOT NULL');
        $this->addSql('ALTER TABLE "order" ADD client_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "order" ADD client_phone VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" ADD client_email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" ADD client_telegram VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" DROP client_user_id');
        $this->addSql('ALTER TABLE "order" DROP worker_user_id');
        $this->addSql('ALTER TABLE "order" DROP execution_date');
        $this->addSql('ALTER TABLE "order" DROP execution_time');
        $this->addSql('ALTER TABLE "order" DROP service_type');
        $this->addSql('ALTER TABLE "order" DROP worker_contact_type');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F529939819EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993986B20BA36 FOREIGN KEY (worker_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F5299398ED5CA9E6 ON "order" (service_id)');
        $this->addSql('CREATE INDEX IDX_F529939819EB6921 ON "order" (client_id)');
        $this->addSql('CREATE INDEX IDX_F52993986B20BA36 ON "order" (worker_id)');
        $this->addSql('ALTER TABLE "user" ADD telegram VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP telegram');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398ED5CA9E6');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F529939819EB6921');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993986B20BA36');
        $this->addSql('DROP INDEX IDX_F5299398ED5CA9E6');
        $this->addSql('DROP INDEX IDX_F529939819EB6921');
        $this->addSql('DROP INDEX IDX_F52993986B20BA36');
        $this->addSql('ALTER TABLE "order" ADD client_user_id INT NOT NULL DEFAULT 1');
        $this->addSql('ALTER TABLE "order" ADD worker_user_id INT NOT NULL DEFAULT 1');
        $this->addSql('ALTER TABLE "order" ADD execution_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" ADD execution_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" ADD worker_contact_type INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" DROP client_id');
        $this->addSql('ALTER TABLE "order" DROP worker_id');
        $this->addSql('ALTER TABLE "order" DROP client_name');
        $this->addSql('ALTER TABLE "order" DROP client_phone');
        $this->addSql('ALTER TABLE "order" DROP client_email');
        $this->addSql('ALTER TABLE "order" DROP client_telegram');
        $this->addSql('ALTER TABLE "order" RENAME COLUMN service_id TO service_type');
        $this->addSql('CREATE INDEX idx_f52993989381a8d8 ON "order" (worker_user_id)');
        $this->addSql('CREATE INDEX idx_f5299398f55397e8 ON "order" (client_user_id)');
    }
}
