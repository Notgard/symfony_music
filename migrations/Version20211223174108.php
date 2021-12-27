<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211223174108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE track_id (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant\', album INT NOT NULL COMMENT \'Clé étrangère Album\', song INT NOT NULL COMMENT \'Clé étrangère Morceau\', diskNumber INT NOT NULL COMMENT \'Numéro du disque\', number INT NOT NULL COMMENT \'Numéro de piste\', duration INT DEFAULT NULL COMMENT \'Durée en secondes\', INDEX song (song), INDEX album (album), INDEX number (number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album CHANGE genre genre INT DEFAULT NULL COMMENT \'Identifiant\', CHANGE artist artist INT DEFAULT NULL COMMENT \'Identifiant\', CHANGE cover cover INT DEFAULT NULL COMMENT \'Identifiant\'');
        $this->addSql('ALTER TABLE track DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE track CHANGE album album INT NOT NULL COMMENT \'Identifiant\', CHANGE song song INT NOT NULL COMMENT \'Identifiant\', CHANGE number number INT NOT NULL COMMENT \'Numéro de piste\', CHANGE disknumber disknumber INT NOT NULL COMMENT \'Numéro du disque\', CHANGE duration duration INT DEFAULT NULL COMMENT \'Durée en secondes\'');
        $this->addSql('ALTER TABLE track ADD PRIMARY KEY (number, disknumber, song, album)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE track_id');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE album CHANGE artist artist INT DEFAULT 0 NOT NULL COMMENT \'Clé étrangère Artiste\', CHANGE genre genre INT DEFAULT NULL COMMENT \'Clé étrangère Genre\', CHANGE cover cover INT DEFAULT NULL COMMENT \'Clé étrangère Pochette\'');
        $this->addSql('ALTER TABLE track DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE track CHANGE number number INT DEFAULT 0 NOT NULL COMMENT \'Numéro de piste\', CHANGE disknumber disknumber INT DEFAULT 0 NOT NULL COMMENT \'Numéro du disque\', CHANGE song song INT DEFAULT 0 NOT NULL COMMENT \'Clé étrangère Morceau\', CHANGE album album INT DEFAULT 0 NOT NULL COMMENT \'Clé étrangère Album\', CHANGE duration duration INT DEFAULT 0 COMMENT \'Durée en secondes\'');
        $this->addSql('ALTER TABLE track ADD PRIMARY KEY (album, song, number, disknumber)');
    }
}
