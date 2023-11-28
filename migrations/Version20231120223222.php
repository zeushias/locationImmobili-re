<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120223222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Database creation with doctrine';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, date_mise_en_ligne DATE NOT NULL, statut VARCHAR(1) NOT NULL, lien_dossier LONGTEXT NOT NULL, idLogement INT DEFAULT NULL, UNIQUE INDEX UNIQ_CB988C6FA35E6E0C (idLogement), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logements (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, nb_pieces INT NOT NULL, numero_etage INT NOT NULL, superficie DOUBLE PRECISION NOT NULL, proprietaire LONGTEXT NOT NULL, adresse_complete LONGTEXT NOT NULL, cp LONGTEXT NOT NULL, ville LONGTEXT NOT NULL, pays LONGTEXT NOT NULL, idTypeLogement INT DEFAULT NULL, INDEX IDX_EEF1F618B7C0C78 (idTypeLogement), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_logement (id INT AUTO_INCREMENT NOT NULL, libelle LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, login LONGTEXT NOT NULL, pass LONGTEXT NOT NULL, email LONGTEXT NOT NULL, nom_complet LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FA35E6E0C FOREIGN KEY (idLogement) REFERENCES logements (id)');
        $this->addSql('ALTER TABLE logements ADD CONSTRAINT FK_EEF1F618B7C0C78 FOREIGN KEY (idTypeLogement) REFERENCES type_logement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FA35E6E0C');
        $this->addSql('ALTER TABLE logements DROP FOREIGN KEY FK_EEF1F618B7C0C78');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE logements');
        $this->addSql('DROP TABLE type_logement');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
