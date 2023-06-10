<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602093625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commant (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, games_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_937DFAB0A76ED395 (user_id), INDEX IDX_937DFAB097FFC673 (games_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, seen INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commant ADD CONSTRAINT FK_937DFAB0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commant ADD CONSTRAINT FK_937DFAB097FFC673 FOREIGN KEY (games_id) REFERENCES games (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commant DROP FOREIGN KEY FK_937DFAB0A76ED395');
        $this->addSql('ALTER TABLE commant DROP FOREIGN KEY FK_937DFAB097FFC673');
        $this->addSql('DROP TABLE commant');
        $this->addSql('DROP TABLE games');
    }
}
