<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211119005959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage DROP INDEX UNIQ_3F9D89552C869050, ADD INDEX IDX_3F9D89552C869050 (station_depart_id)');
        $this->addSql('ALTER TABLE voyage DROP INDEX UNIQ_3F9D89557686E853, ADD INDEX IDX_3F9D89557686E853 (station_arrive_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage DROP INDEX IDX_3F9D89552C869050, ADD UNIQUE INDEX UNIQ_3F9D89552C869050 (station_depart_id)');
        $this->addSql('ALTER TABLE voyage DROP INDEX IDX_3F9D89557686E853, ADD UNIQUE INDEX UNIQ_3F9D89557686E853 (station_arrive_id)');
    }
}
