<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705165804 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magasin_stock (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_premiere (id INT AUTO_INCREMENT NOT NULL, magasin_stock_id INT NOT NULL, code VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_179505B76F67C316 (magasin_stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_premiere_commande (id INT AUTO_INCREMENT NOT NULL, matiere_premiere_id INT NOT NULL, commande_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_87EC2B955B42BE3C (matiere_premiere_id), UNIQUE INDEX UNIQ_87EC2B9582EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matiere_premiere ADD CONSTRAINT FK_179505B76F67C316 FOREIGN KEY (magasin_stock_id) REFERENCES magasin_stock (id)');
        $this->addSql('ALTER TABLE matiere_premiere_commande ADD CONSTRAINT FK_87EC2B955B42BE3C FOREIGN KEY (matiere_premiere_id) REFERENCES matiere_premiere (id)');
        $this->addSql('ALTER TABLE matiere_premiere_commande ADD CONSTRAINT FK_87EC2B9582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere_premiere_commande DROP FOREIGN KEY FK_87EC2B9582EA2E54');
        $this->addSql('ALTER TABLE matiere_premiere DROP FOREIGN KEY FK_179505B76F67C316');
        $this->addSql('ALTER TABLE matiere_premiere_commande DROP FOREIGN KEY FK_87EC2B955B42BE3C');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE magasin_stock');
        $this->addSql('DROP TABLE matiere_premiere');
        $this->addSql('DROP TABLE matiere_premiere_commande');
    }
}
