<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200818000326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_commande ADD matiere_p_id INT NOT NULL');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA6A0A9E5FC FOREIGN KEY (matiere_p_id) REFERENCES matiere_premiere (id)');
        $this->addSql('CREATE INDEX IDX_98344FA6A0A9E5FC ON detail_commande (matiere_p_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA6A0A9E5FC');
        $this->addSql('DROP INDEX IDX_98344FA6A0A9E5FC ON detail_commande');
        $this->addSql('ALTER TABLE detail_commande DROP matiere_p_id');
    }
}
