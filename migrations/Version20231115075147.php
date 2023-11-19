<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115075147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE info (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, library_id INT NOT NULL, info_genre VARCHAR(255) DEFAULT NULL, info_type VARCHAR(255) DEFAULT NULL, info_pic VARCHAR(255) DEFAULT NULL, info_desc LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_CB893157A76ED395 (user_id), UNIQUE INDEX UNIQ_CB893157FE2541D7 (library_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB893157A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB893157FE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB893157A76ED395');
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB893157FE2541D7');
        $this->addSql('DROP TABLE info');
    }
}
