<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230205161801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "todo_list_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE refresh_tokens (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens (refresh_token)');
        $this->addSql('CREATE TABLE "todo" (id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A0EB6A0A76ED395 ON "todo" (user_id)');
        $this->addSql('CREATE TABLE "todo_list" (id INT NOT NULL, todo_id INT NOT NULL, name VARCHAR(100) NOT NULL, done BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1B199E07EA1EBC33 ON "todo_list" (todo_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "todo" ADD CONSTRAINT FK_5A0EB6A0A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "todo_list" ADD CONSTRAINT FK_1B199E07EA1EBC33 FOREIGN KEY (todo_id) REFERENCES "todo" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "todo_list_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "todo" DROP CONSTRAINT FK_5A0EB6A0A76ED395');
        $this->addSql('ALTER TABLE "todo_list" DROP CONSTRAINT FK_1B199E07EA1EBC33');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE "todo"');
        $this->addSql('DROP TABLE "todo_list"');
        $this->addSql('DROP TABLE "user"');
    }
}
