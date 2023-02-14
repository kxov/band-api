<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214131047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE band_genre (band_id INT UNSIGNED NOT NULL, genre_id INT UNSIGNED NOT NULL, INDEX IDX_7FB28D6449ABEB17 (band_id), INDEX IDX_7FB28D644296D31F (genre_id), PRIMARY KEY(band_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE band_genre ADD CONSTRAINT FK_7FB28D6449ABEB17 FOREIGN KEY (band_id) REFERENCES band (id)');
        $this->addSql('ALTER TABLE band_genre ADD CONSTRAINT FK_7FB28D644296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band_genre DROP FOREIGN KEY FK_7FB28D6449ABEB17');
        $this->addSql('ALTER TABLE band_genre DROP FOREIGN KEY FK_7FB28D644296D31F');
        $this->addSql('DROP TABLE band_genre');
    }
}
