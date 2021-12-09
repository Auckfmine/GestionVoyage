<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209182023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moy_transport (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrive VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, iduser VARCHAR(255) NOT NULL, date DATE NOT NULL, ref VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_archive (id INT AUTO_INCREMENT NOT NULL, ref_voyage VARCHAR(120) DEFAULT NULL, station_depart INT DEFAULT NULL, moyen_de_transport INT DEFAULT NULL, date_depart DATETIME DEFAULT NULL, date_arrive DATETIME DEFAULT NULL, station_arrive INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE role role enum(\'CLIENT\', \'ADMIN\',\'RESPONSABLE_ABONNEMENT\',\'RESPONSABLE_RECLAMATION\',\'RESPONSABLE_MDT\',\'RESPONSABLE_VOYAGE\',\'RESPONSABLE_RESERVATION\')');
        $this->addSql('ALTER TABLE voyage DROP INDEX IDX_3F9D89554B31287, ADD UNIQUE INDEX UNIQ_3F9D89554B31287 (moyen_de_transport_id)');
        $this->addSql('ALTER TABLE voyage DROP INDEX IDX_3F9D89552C869050, ADD UNIQUE INDEX UNIQ_3F9D89552C869050 (station_depart_id)');
        $this->addSql('ALTER TABLE voyage DROP INDEX IDX_3F9D89557686E853, ADD UNIQUE INDEX UNIQ_3F9D89557686E853 (station_arrive_id)');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554B31287');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89552C869050');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89557686E853');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554B31287 FOREIGN KEY (moyen_de_transport_id) REFERENCES moyen_de_transport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89552C869050 FOREIGN KEY (station_depart_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557686E853 FOREIGN KEY (station_arrive_id) REFERENCES station (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE moy_transport');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE voyage_archive');
        $this->addSql('ALTER TABLE user CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE voyage DROP INDEX UNIQ_3F9D89552C869050, ADD INDEX IDX_3F9D89552C869050 (station_depart_id)');
        $this->addSql('ALTER TABLE voyage DROP INDEX UNIQ_3F9D89557686E853, ADD INDEX IDX_3F9D89557686E853 (station_arrive_id)');
        $this->addSql('ALTER TABLE voyage DROP INDEX UNIQ_3F9D89554B31287, ADD INDEX IDX_3F9D89554B31287 (moyen_de_transport_id)');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89552C869050');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89557686E853');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554B31287');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89552C869050 FOREIGN KEY (station_depart_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557686E853 FOREIGN KEY (station_arrive_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554B31287 FOREIGN KEY (moyen_de_transport_id) REFERENCES moyen_de_transport (id)');
    }
}
