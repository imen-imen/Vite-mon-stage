<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250728084630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EAC3FB681');
        $this->addSql('DROP INDEX IDX_29D6873EAC3FB681 ON offer');
        $this->addSql('ALTER TABLE offer CHANGE duration duration INT NOT NULL, CHANGE domain_id_id domain_id INT NOT NULL, CHANGE location localisation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id)');
        $this->addSql('CREATE INDEX IDX_29D6873E115F0EE5 ON offer (domain_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E115F0EE5');
        $this->addSql('DROP INDEX IDX_29D6873E115F0EE5 ON offer');
        $this->addSql('ALTER TABLE offer CHANGE duration duration VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', CHANGE domain_id domain_id_id INT NOT NULL, CHANGE localisation location VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EAC3FB681 FOREIGN KEY (domain_id_id) REFERENCES domain (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29D6873EAC3FB681 ON offer (domain_id_id)');
    }
}
