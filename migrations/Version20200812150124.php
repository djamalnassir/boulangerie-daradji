<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200812150124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detail_production (id INT AUTO_INCREMENT NOT NULL, production_id INT NOT NULL, matiere_premiere_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_68F70136ECC6147F (production_id), UNIQUE INDEX UNIQ_68F701365B42BE3C (matiere_premiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_produit_fini (id INT AUTO_INCREMENT NOT NULL, production_id INT NOT NULL, produit_fini_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_82840F59ECC6147F (production_id), UNIQUE INDEX UNIQ_82840F5965261ECD (produit_fini_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, date_production DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_fini (id INT AUTO_INCREMENT NOT NULL, detail_produit_fini_id INT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_9E87655668618B7B (detail_produit_fini_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user_id INT NOT NULL, date_vente DATE NOT NULL, INDEX IDX_888A2A4C19EB6921 (client_id), INDEX IDX_888A2A4CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_production ADD CONSTRAINT FK_68F70136ECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE detail_production ADD CONSTRAINT FK_68F701365B42BE3C FOREIGN KEY (matiere_premiere_id) REFERENCES matiere_premiere (id)');
        $this->addSql('ALTER TABLE detail_produit_fini ADD CONSTRAINT FK_82840F59ECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE detail_produit_fini ADD CONSTRAINT FK_82840F5965261ECD FOREIGN KEY (produit_fini_id) REFERENCES produit_fini (id)');
        $this->addSql('ALTER TABLE produit_fini ADD CONSTRAINT FK_9E87655668618B7B FOREIGN KEY (detail_produit_fini_id) REFERENCES detail_produit_fini (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_fini DROP FOREIGN KEY FK_9E87655668618B7B');
        $this->addSql('ALTER TABLE detail_production DROP FOREIGN KEY FK_68F70136ECC6147F');
        $this->addSql('ALTER TABLE detail_produit_fini DROP FOREIGN KEY FK_82840F59ECC6147F');
        $this->addSql('ALTER TABLE detail_produit_fini DROP FOREIGN KEY FK_82840F5965261ECD');
        $this->addSql('DROP TABLE detail_production');
        $this->addSql('DROP TABLE detail_produit_fini');
        $this->addSql('DROP TABLE production');
        $this->addSql('DROP TABLE produit_fini');
        $this->addSql('DROP TABLE vente');
    }
}
