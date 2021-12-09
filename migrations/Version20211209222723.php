<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209222723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, abonnement_disponible_id INT DEFAULT NULL, user_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, tel INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_351268BB14FC86E6 (abonnement_disponible_id), INDEX IDX_351268BBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abonnement_disponible (id INT AUTO_INCREMENT NOT NULL, descr VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, prix_mois DOUBLE PRECISION NOT NULL, prix_semestre DOUBLE PRECISION NOT NULL, prix_annuel DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB14FC86E6 FOREIGN KEY (abonnement_disponible_id) REFERENCES abonnement_disponible (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE voyage_archive');
        $this->addSql('ALTER TABLE depot CHANGE capacite capacite INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE role role enum(\'CLIENT\', \'ADMIN\',\'RESPONSABLE_ABONNEMENT\',\'RESPONSABLE_RECLAMATION\',\'RESPONSABLE_MDT\',\'RESPONSABLE_VOYAGE\',\'RESPONSABLE_RESERVATION\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB14FC86E6');
        $this->addSql('CREATE TABLE voyage_archive (id INT AUTO_INCREMENT NOT NULL, ref_voyage VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, station_depart INT DEFAULT NULL, moyen_de_transport INT DEFAULT NULL, date_depart DATETIME DEFAULT NULL, date_arrive DATETIME DEFAULT NULL, station_arrive INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE abonnement_disponible');
        $this->addSql('ALTER TABLE depot CHANGE capacite capacite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
