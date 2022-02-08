<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604093319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entretien ADD id_condidature_id INT NOT NULL');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DA7192A435 FOREIGN KEY (id_condidature_id) REFERENCES condidature (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B58D6DA7192A435 ON entretien (id_condidature_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DA7192A435');
        $this->addSql('DROP INDEX UNIQ_2B58D6DA7192A435 ON entretien');
        $this->addSql('ALTER TABLE entretien DROP id_condidature_id');
    }
}
