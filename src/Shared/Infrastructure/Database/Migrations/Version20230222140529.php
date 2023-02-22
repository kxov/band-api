<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222140529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE todo CHANGE user_id user_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) NOT NULL COMMENT \'(DC2Type:user_user_role)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE `todo` CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP role, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
