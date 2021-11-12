<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211111224624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moyen_de_transport (id INT AUTO_INCREMENT NOT NULL, ref VARCHAR(128) NOT NULL, type_mt VARCHAR(128) NOT NULL, accessible_handicap TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1E6E5727146F3EA3 (ref), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, ref_station VARCHAR(128) NOT NULL, nom_station VARCHAR(128) NOT NULL, position_station VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_9F39F8B15B2DAB61 (ref_station), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, station_depart_id INT NOT NULL, station_arrive_id INT NOT NULL, moyen_de_transport_id INT NOT NULL, ref_voyage VARCHAR(128) NOT NULL, ligne LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', date_depart DATETIME NOT NULL, date_arrive DATETIME NOT NULL, UNIQUE INDEX UNIQ_3F9D89554A84E1AC (ref_voyage), UNIQUE INDEX UNIQ_3F9D89552C869050 (station_depart_id), UNIQUE INDEX UNIQ_3F9D89557686E853 (station_arrive_id), UNIQUE INDEX UNIQ_3F9D89554B31287 (moyen_de_transport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89552C869050 FOREIGN KEY (station_depart_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557686E853 FOREIGN KEY (station_arrive_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554B31287 FOREIGN KEY (moyen_de_transport_id) REFERENCES moyen_de_transport (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554B31287');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89552C869050');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89557686E853');
        $this->addSql('DROP TABLE moyen_de_transport');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE voyage');
    }
}
