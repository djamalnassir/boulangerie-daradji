<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200819155953 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appro ADD commande_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE appro ADD CONSTRAINT FK_9DBA069182EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE appro ADD CONSTRAINT FK_9DBA0691A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9DBA069182EA2E54 ON appro (commande_id)');
        $this->addSql('CREATE INDEX IDX_9DBA0691A76ED395 ON appro (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appro DROP FOREIGN KEY FK_9DBA069182EA2E54');
        $this->addSql('ALTER TABLE appro DROP FOREIGN KEY FK_9DBA0691A76ED395');
        $this->addSql('DROP INDEX IDX_9DBA069182EA2E54 ON appro');
        $this->addSql('DROP INDEX IDX_9DBA0691A76ED395 ON appro');
        $this->addSql('ALTER TABLE appro DROP commande_id, DROP user_id');
    }
}
