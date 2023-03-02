<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230302152742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todo DROP FOREIGN KEY FK_5A0EB6A0A76ED395');
        $this->addSql('ALTER TABLE todo_list DROP FOREIGN KEY FK_1B199E07EA1EBC33');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP TABLE todo_list');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE todo (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_5A0EB6A0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE todo_list (id INT AUTO_INCREMENT NOT NULL, todo_id INT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, done TINYINT(1) NOT NULL, INDEX IDX_1B199E07EA1EBC33 (todo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE todo_list ADD CONSTRAINT FK_1B199E07EA1EBC33 FOREIGN KEY (todo_id) REFERENCES todo (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
