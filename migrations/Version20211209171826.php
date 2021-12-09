<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209171826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(62) NOT NULL, number INT NOT NULL, username VARCHAR(150) NOT NULL, password VARCHAR(32) NOT NULL, role enum(\'CLIENT\', \'ADMIN\',\'RESPONSABLE_ABONNEMENT\',\'RESPONSABLE_RECLAMATION\',\'RESPONSABLE_MDT\',\'RESPONSABLE_VOYAGE\',\'RESPONSABLE_RESERVATION\'), birthday DATE NOT NULL, created_date_user DATETIME NOT NULL, last_updated_user DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depot CHANGE capacite capacite VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE moyen_de_transport CHANGE prix_achat prix_achat DOUBLE PRECISION NOT NULL, CHANGE date_de_mise_en_circulations date_de_mise_en_circulation DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE depot CHANGE capacite capacite INT NOT NULL');
        $this->addSql('ALTER TABLE moyen_de_transport CHANGE prix_achat prix_achat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_de_mise_en_circulation date_de_mise_en_circulations DATE NOT NULL');
    }
}
