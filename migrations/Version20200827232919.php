<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200827232919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_appro DROP INDEX IDX_E04ACDC85B42BE3C, ADD UNIQUE INDEX UNIQ_E04ACDC85B42BE3C (matiere_premiere_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_appro DROP INDEX UNIQ_E04ACDC85B42BE3C, ADD INDEX IDX_E04ACDC85B42BE3C (matiere_premiere_id)');
    }
}
