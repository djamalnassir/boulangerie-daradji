<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200817122800 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_commande DROP INDEX IDX_98344FA65B42BE3C, ADD UNIQUE INDEX UNIQ_98344FA65B42BE3C (matiere_premiere_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_commande DROP INDEX UNIQ_98344FA65B42BE3C, ADD INDEX IDX_98344FA65B42BE3C (matiere_premiere_id)');
    }
}
