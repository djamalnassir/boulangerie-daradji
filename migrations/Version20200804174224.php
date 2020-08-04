<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200804174224 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appro (id INT AUTO_INCREMENT NOT NULL, date_appro DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_appro (id INT AUTO_INCREMENT NOT NULL, appro_id INT NOT NULL, matiere_premiere_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_E04ACDC8E77EEA7E (appro_id), UNIQUE INDEX UNIQ_E04ACDC85B42BE3C (matiere_premiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_appro ADD CONSTRAINT FK_E04ACDC8E77EEA7E FOREIGN KEY (appro_id) REFERENCES appro (id)');
        $this->addSql('ALTER TABLE detail_appro ADD CONSTRAINT FK_E04ACDC85B42BE3C FOREIGN KEY (matiere_premiere_id) REFERENCES matiere_premiere (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_appro DROP FOREIGN KEY FK_E04ACDC8E77EEA7E');
        $this->addSql('DROP TABLE appro');
        $this->addSql('DROP TABLE detail_appro');
    }
}
