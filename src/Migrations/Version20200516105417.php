<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516105417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche_service_employer ADD employe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_service_employer ADD CONSTRAINT FK_E7AD042E1B65292 FOREIGN KEY (employe_id) REFERENCES employ (id)');
        $this->addSql('CREATE INDEX IDX_E7AD042E1B65292 ON fiche_service_employer (employe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche_service_employer DROP FOREIGN KEY FK_E7AD042E1B65292');
        $this->addSql('DROP INDEX IDX_E7AD042E1B65292 ON fiche_service_employer');
        $this->addSql('ALTER TABLE fiche_service_employer DROP employe_id');
    }
}
