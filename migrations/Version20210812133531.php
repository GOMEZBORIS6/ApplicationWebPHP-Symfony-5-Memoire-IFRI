<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812133531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE programmation DROP FOREIGN KEY FK_5E9F80E3DC304035');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP INDEX IDX_5E9F80E3DC304035 ON programmation');
        $this->addSql('ALTER TABLE programmation DROP salle_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salle (idsalle INT AUTO_INCREMENT NOT NULL, libsalle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(idsalle)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE programmation ADD salle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE programmation ADD CONSTRAINT FK_5E9F80E3DC304035 FOREIGN KEY (salle_id) REFERENCES salle (idsalle)');
        $this->addSql('CREATE INDEX IDX_5E9F80E3DC304035 ON programmation (salle_id)');
    }
}
