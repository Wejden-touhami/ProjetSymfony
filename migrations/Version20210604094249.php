<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604094249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE confirmation ADD entretien_id INT NOT NULL');
        $this->addSql('ALTER TABLE confirmation ADD CONSTRAINT FK_483D123C548DCEA2 FOREIGN KEY (entretien_id) REFERENCES entretien (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_483D123C548DCEA2 ON confirmation (entretien_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE confirmation DROP FOREIGN KEY FK_483D123C548DCEA2');
        $this->addSql('DROP INDEX UNIQ_483D123C548DCEA2 ON confirmation');
        $this->addSql('ALTER TABLE confirmation DROP entretien_id');
    }
}
