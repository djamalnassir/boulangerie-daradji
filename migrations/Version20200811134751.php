<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811134751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detail_commande (id INT AUTO_INCREMENT NOT NULL, matiere_premiere_id INT NOT NULL, commande_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_98344FA65B42BE3C (matiere_premiere_id), INDEX IDX_98344FA682EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA65B42BE3C FOREIGN KEY (matiere_premiere_id) REFERENCES matiere_premiere (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('DROP TABLE matiere_premiere_commande');
        $this->addSql('ALTER TABLE detail_appro DROP INDEX UNIQ_E04ACDC85B42BE3C, ADD INDEX IDX_E04ACDC85B42BE3C (matiere_premiere_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matiere_premiere_commande (id INT AUTO_INCREMENT NOT NULL, matiere_premiere_id INT NOT NULL, commande_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_87EC2B9582EA2E54 (commande_id), UNIQUE INDEX UNIQ_87EC2B955B42BE3C (matiere_premiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE matiere_premiere_commande ADD CONSTRAINT FK_87EC2B955B42BE3C FOREIGN KEY (matiere_premiere_id) REFERENCES matiere_premiere (id)');
        $this->addSql('ALTER TABLE matiere_premiere_commande ADD CONSTRAINT FK_87EC2B9582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('DROP TABLE detail_commande');
        $this->addSql('ALTER TABLE detail_appro DROP INDEX IDX_E04ACDC85B42BE3C, ADD UNIQUE INDEX UNIQ_E04ACDC85B42BE3C (matiere_premiere_id)');
    }
}
