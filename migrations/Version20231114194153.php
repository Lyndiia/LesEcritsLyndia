<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114194153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, art_title VARCHAR(255) NOT NULL, art_desc LONGTEXT NOT NULL, art_pic VARCHAR(255) DEFAULT NULL, art_content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_story (article_id INT NOT NULL, story_id INT NOT NULL, INDEX IDX_9CE176297294869C (article_id), INDEX IDX_9CE17629AA5D4036 (story_id), PRIMARY KEY(article_id, story_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, story_id INT DEFAULT NULL, chap_title VARCHAR(255) NOT NULL, chap_content LONGTEXT NOT NULL, INDEX IDX_F981B52EAA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_send_id INT DEFAULT NULL, article_id INT DEFAULT NULL, comm_content LONGTEXT NOT NULL, INDEX IDX_9474526C4B9E2071 (user_send_id), INDEX IDX_9474526C7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, cont_user_id INT DEFAULT NULL, cont_name VARCHAR(255) NOT NULL, cont_email VARCHAR(255) NOT NULL, cont_content LONGTEXT NOT NULL, INDEX IDX_4C62E638335051F2 (cont_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE library (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, UNIQUE INDEX UNIQ_A18098BC9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE library_story (library_id INT NOT NULL, story_id INT NOT NULL, INDEX IDX_D8F3D617FE2541D7 (library_id), INDEX IDX_D8F3D617AA5D4036 (story_id), PRIMARY KEY(library_id, story_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE private_mess (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, recipient_id INT NOT NULL, mess_title VARCHAR(255) DEFAULT NULL, mess_content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_read TINYINT(1) NOT NULL, INDEX IDX_FBC88704F624B39D (sender_id), INDEX IDX_FBC88704E92F8F78 (recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE story (id INT AUTO_INCREMENT NOT NULL, story_title VARCHAR(255) NOT NULL, story_genre VARCHAR(255) DEFAULT NULL, story_pic VARCHAR(255) DEFAULT NULL, story_desc LONGTEXT NOT NULL, story_content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, user_pseudo VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE writing (id INT AUTO_INCREMENT NOT NULL, user_send_id INT NOT NULL, article_id INT DEFAULT NULL, writ_content LONGTEXT NOT NULL, writ_attachment VARCHAR(255) DEFAULT NULL, INDEX IDX_ED98FD9B4B9E2071 (user_send_id), INDEX IDX_ED98FD9B7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_story ADD CONSTRAINT FK_9CE176297294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_story ADD CONSTRAINT FK_9CE17629AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52EAA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B9E2071 FOREIGN KEY (user_send_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638335051F2 FOREIGN KEY (cont_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE library ADD CONSTRAINT FK_A18098BC9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE library_story ADD CONSTRAINT FK_D8F3D617FE2541D7 FOREIGN KEY (library_id) REFERENCES library (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE library_story ADD CONSTRAINT FK_D8F3D617AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE private_mess ADD CONSTRAINT FK_FBC88704F624B39D FOREIGN KEY (sender_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE private_mess ADD CONSTRAINT FK_FBC88704E92F8F78 FOREIGN KEY (recipient_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE writing ADD CONSTRAINT FK_ED98FD9B4B9E2071 FOREIGN KEY (user_send_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE writing ADD CONSTRAINT FK_ED98FD9B7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_story DROP FOREIGN KEY FK_9CE176297294869C');
        $this->addSql('ALTER TABLE article_story DROP FOREIGN KEY FK_9CE17629AA5D4036');
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52EAA5D4036');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B9E2071');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638335051F2');
        $this->addSql('ALTER TABLE library DROP FOREIGN KEY FK_A18098BC9D86650F');
        $this->addSql('ALTER TABLE library_story DROP FOREIGN KEY FK_D8F3D617FE2541D7');
        $this->addSql('ALTER TABLE library_story DROP FOREIGN KEY FK_D8F3D617AA5D4036');
        $this->addSql('ALTER TABLE private_mess DROP FOREIGN KEY FK_FBC88704F624B39D');
        $this->addSql('ALTER TABLE private_mess DROP FOREIGN KEY FK_FBC88704E92F8F78');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE writing DROP FOREIGN KEY FK_ED98FD9B4B9E2071');
        $this->addSql('ALTER TABLE writing DROP FOREIGN KEY FK_ED98FD9B7294869C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_story');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE library_story');
        $this->addSql('DROP TABLE private_mess');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE story');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE writing');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
