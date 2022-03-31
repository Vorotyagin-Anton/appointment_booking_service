<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220327192317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, client_user_id INT NOT NULL, worker_user_id INT NOT NULL, execution_date DATE DEFAULT NULL, execution_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, service_type INT DEFAULT NULL, worker_contact_type INT DEFAULT NULL, client_contact_type INT NOT NULL, status INT NOT NULL, details TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398F55397E8 ON "order" (client_user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F52993989381A8D8 ON "order" (worker_user_id)');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398F55397E8 FOREIGN KEY (client_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993989381A8D8 FOREIGN KEY (worker_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP TABLE "order"');
    }
}
