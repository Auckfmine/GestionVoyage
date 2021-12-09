<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209150159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, capacite INT NOT NULL, categorie VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) DEFAULT NULL, object VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_archive (id INT AUTO_INCREMENT NOT NULL, ref_voyage VARCHAR(120) DEFAULT NULL, station_depart INT DEFAULT NULL, moyen_de_transport INT DEFAULT NULL, date_depart DATETIME DEFAULT NULL, date_arrive DATETIME DEFAULT NULL, station_arrive INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX UNIQ_1E6E5727146F3EA3 ON moyen_de_transport');
        $this->addSql('ALTER TABLE moyen_de_transport ADD depot_id INT DEFAULT NULL, ADD type VARCHAR(255) NOT NULL, ADD num_ligne VARCHAR(255) NOT NULL, ADD date_de_mise_en_circulations DATE NOT NULL, ADD etat VARCHAR(255) NOT NULL, ADD accessible_au_handicape VARCHAR(255) NOT NULL, ADD prix_achat VARCHAR(255) NOT NULL, ADD poids DOUBLE PRECISION NOT NULL, ADD longueur DOUBLE PRECISION NOT NULL, ADD largeur DOUBLE PRECISION NOT NULL, ADD energie VARCHAR(255) NOT NULL, ADD nombre_de_place INT NOT NULL, DROP ref, DROP type_mt, DROP accessible_handicap');
        $this->addSql('ALTER TABLE moyen_de_transport ADD CONSTRAINT FK_1E6E57278510D4DE FOREIGN KEY (depot_id) REFERENCES depot (id)');
        $this->addSql('CREATE INDEX IDX_1E6E57278510D4DE ON moyen_de_transport (depot_id)');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89552C869050');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89557686E853');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554B31287');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89552C869050 FOREIGN KEY (station_depart_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557686E853 FOREIGN KEY (station_arrive_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554B31287 FOREIGN KEY (moyen_de_transport_id) REFERENCES moyen_de_transport (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moyen_de_transport DROP FOREIGN KEY FK_1E6E57278510D4DE');
        $this->addSql('DROP TABLE depot');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE voyage_archive');
        $this->addSql('DROP INDEX IDX_1E6E57278510D4DE ON moyen_de_transport');
        $this->addSql('ALTER TABLE moyen_de_transport ADD ref VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD type_mt VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD accessible_handicap TINYINT(1) NOT NULL, DROP depot_id, DROP type, DROP num_ligne, DROP date_de_mise_en_circulations, DROP etat, DROP accessible_au_handicape, DROP prix_achat, DROP poids, DROP longueur, DROP largeur, DROP energie, DROP nombre_de_place');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1E6E5727146F3EA3 ON moyen_de_transport (ref)');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89552C869050');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89557686E853');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554B31287');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89552C869050 FOREIGN KEY (station_depart_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557686E853 FOREIGN KEY (station_arrive_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554B31287 FOREIGN KEY (moyen_de_transport_id) REFERENCES moyen_de_transport (id)');
    }
}
