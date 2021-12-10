<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211210001801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, object VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_CE60640412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user CHANGE role role enum(\'CLIENT\', \'ADMIN\',\'RESPONSABLE_ABONNEMENT\',\'RESPONSABLE_RECLAMATION\',\'RESPONSABLE_MDT\',\'RESPONSABLE_VOYAGE\',\'RESPONSABLE_RESERVATION\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640412469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('ALTER TABLE user CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
