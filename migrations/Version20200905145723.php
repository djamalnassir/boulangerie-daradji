<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200905145723 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente ADD produit_fini_id INT NOT NULL');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C65261ECD FOREIGN KEY (produit_fini_id) REFERENCES produit_fini (id)');
        $this->addSql('CREATE INDEX IDX_888A2A4C65261ECD ON vente (produit_fini_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C65261ECD');
        $this->addSql('DROP INDEX IDX_888A2A4C65261ECD ON vente');
        $this->addSql('ALTER TABLE vente DROP produit_fini_id');
    }
}
