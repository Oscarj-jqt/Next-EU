<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319084339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create base tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, content VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B6BD307FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, profilePicture VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, thumbnail VARCHAR(255) DEFAULT NULL, views INT NOT NULL, country VARCHAR(100) NOT NULL, category VARCHAR(100) NOT NULL, googleMapsUrl VARCHAR(255) DEFAULT NULL, createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CC7DA2CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_saved (video_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7681DA8729C1004E (video_id), INDEX IDX_7681DA87A76ED395 (user_id), PRIMARY KEY(video_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_ratings (video_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2B5BEE6429C1004E (video_id), INDEX IDX_2B5BEE64A76ED395 (user_id), PRIMARY KEY(video_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE video_saved ADD CONSTRAINT FK_7681DA8729C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_saved ADD CONSTRAINT FK_7681DA87A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_ratings ADD CONSTRAINT FK_2B5BEE6429C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_ratings ADD CONSTRAINT FK_2B5BEE64A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CA76ED395');
        $this->addSql('ALTER TABLE video_saved DROP FOREIGN KEY FK_7681DA8729C1004E');
        $this->addSql('ALTER TABLE video_saved DROP FOREIGN KEY FK_7681DA87A76ED395');
        $this->addSql('ALTER TABLE video_ratings DROP FOREIGN KEY FK_2B5BEE6429C1004E');
        $this->addSql('ALTER TABLE video_ratings DROP FOREIGN KEY FK_2B5BEE64A76ED395');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE video_saved');
        $this->addSql('DROP TABLE video_ratings');
    }
}
