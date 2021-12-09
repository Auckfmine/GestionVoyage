<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209205537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, capacite VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moy_transport (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrive VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moyen_de_transport (id INT AUTO_INCREMENT NOT NULL, depot_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, num_ligne VARCHAR(255) NOT NULL, date_de_mise_en_circulation DATE NOT NULL, etat VARCHAR(255) NOT NULL, accessible_au_handicape VARCHAR(255) NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, poids DOUBLE PRECISION NOT NULL, longueur DOUBLE PRECISION NOT NULL, largeur DOUBLE PRECISION NOT NULL, energie VARCHAR(255) NOT NULL, nombre_de_place INT NOT NULL, INDEX IDX_1E6E57278510D4DE (depot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, iduser VARCHAR(255) NOT NULL, date DATE NOT NULL, ref VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, ref_station VARCHAR(128) NOT NULL, nom_station VARCHAR(128) NOT NULL, position_station VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_9F39F8B15B2DAB61 (ref_station), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(62) NOT NULL, number INT NOT NULL, username VARCHAR(150) NOT NULL, password VARCHAR(32) NOT NULL, role enum(\'CLIENT\', \'ADMIN\',\'RESPONSABLE_ABONNEMENT\',\'RESPONSABLE_RECLAMATION\',\'RESPONSABLE_MDT\',\'RESPONSABLE_VOYAGE\',\'RESPONSABLE_RESERVATION\'), birthday DATE NOT NULL, created_date_user DATETIME NOT NULL, last_updated_user DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, station_depart_id INT NOT NULL, station_arrive_id INT NOT NULL, moyen_de_transport_id INT NOT NULL, ref_voyage VARCHAR(128) NOT NULL, ligne LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', date_depart DATETIME NOT NULL, date_arrive DATETIME NOT NULL, UNIQUE INDEX UNIQ_3F9D89554A84E1AC (ref_voyage), UNIQUE INDEX UNIQ_3F9D89552C869050 (station_depart_id), UNIQUE INDEX UNIQ_3F9D89557686E853 (station_arrive_id), UNIQUE INDEX UNIQ_3F9D89554B31287 (moyen_de_transport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_archive (id INT AUTO_INCREMENT NOT NULL, ref_voyage VARCHAR(120) DEFAULT NULL, station_depart INT DEFAULT NULL, moyen_de_transport INT DEFAULT NULL, date_depart DATETIME DEFAULT NULL, date_arrive DATETIME DEFAULT NULL, station_arrive INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE moyen_de_transport ADD CONSTRAINT FK_1E6E57278510D4DE FOREIGN KEY (depot_id) REFERENCES depot (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89552C869050 FOREIGN KEY (station_depart_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557686E853 FOREIGN KEY (station_arrive_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554B31287 FOREIGN KEY (moyen_de_transport_id) REFERENCES moyen_de_transport (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moyen_de_transport DROP FOREIGN KEY FK_1E6E57278510D4DE');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554B31287');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89552C869050');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89557686E853');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE depot');
        $this->addSql('DROP TABLE moy_transport');
        $this->addSql('DROP TABLE moyen_de_transport');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_archive');
    }
}
