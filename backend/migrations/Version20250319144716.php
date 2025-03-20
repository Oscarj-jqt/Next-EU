<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319144716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz_question DROP FOREIGN KEY FK_6033B00BFAE1C4AC');
        $this->addSql('CREATE TABLE quiz_connection (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_6098545AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quiz_connection ADD CONSTRAINT FK_6098545AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_connections DROP FOREIGN KEY FK_90D0EFB561220EA6');
        $this->addSql('ALTER TABLE quiz_connections DROP FOREIGN KEY FK_90D0EFB59D1C3019');
        $this->addSql('ALTER TABLE quiz_queue DROP FOREIGN KEY FK_838E06E3BEC1F3D7');
        $this->addSql('DROP TABLE quiz_connections');
        $this->addSql('DROP TABLE quiz_queue');
        $this->addSql('DROP INDEX IDX_6033B00BFAE1C4AC ON quiz_question');
        $this->addSql('ALTER TABLE quiz_question CHANGE quiz_connections_id quiz_answered_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz_question ADD CONSTRAINT FK_6033B00B969CF32D FOREIGN KEY (quiz_answered_id) REFERENCES quiz_connection (id)');
        $this->addSql('CREATE INDEX IDX_6033B00B969CF32D ON quiz_question (quiz_answered_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz_question DROP FOREIGN KEY FK_6033B00B969CF32D');
        $this->addSql('CREATE TABLE quiz_connections (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, participant_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_90D0EFB561220EA6 (creator_id), INDEX IDX_90D0EFB59D1C3019 (participant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz_queue (id INT AUTO_INCREMENT NOT NULL, queued_user_id INT NOT NULL, search_country VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_838E06E3BEC1F3D7 (queued_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE quiz_connections ADD CONSTRAINT FK_90D0EFB561220EA6 FOREIGN KEY (creator_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE quiz_connections ADD CONSTRAINT FK_90D0EFB59D1C3019 FOREIGN KEY (participant_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE quiz_queue ADD CONSTRAINT FK_838E06E3BEC1F3D7 FOREIGN KEY (queued_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE quiz_connection DROP FOREIGN KEY FK_6098545AA76ED395');
        $this->addSql('DROP TABLE quiz_connection');
        $this->addSql('DROP INDEX IDX_6033B00B969CF32D ON quiz_question');
        $this->addSql('ALTER TABLE quiz_question CHANGE quiz_answered_id quiz_connections_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz_question ADD CONSTRAINT FK_6033B00BFAE1C4AC FOREIGN KEY (quiz_connections_id) REFERENCES quiz_connections (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6033B00BFAE1C4AC ON quiz_question (quiz_connections_id)');
    }
}
