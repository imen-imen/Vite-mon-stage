<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250715135030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidacy (id INT AUTO_INCREMENT NOT NULL, apprentice_id_id INT NOT NULL, offer_id_id INT NOT NULL, message LONGTEXT DEFAULT NULL, date_candidacy DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D930569D336C542C (apprentice_id_id), INDEX IDX_D930569DFC69E3BE (offer_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, domain_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, location VARCHAR(255) NOT NULL, start_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', duration VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_29D6873EAC3FB681 (domain_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidacy ADD CONSTRAINT FK_D930569D336C542C FOREIGN KEY (apprentice_id_id) REFERENCES apprentice (id)');
        $this->addSql('ALTER TABLE candidacy ADD CONSTRAINT FK_D930569DFC69E3BE FOREIGN KEY (offer_id_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EAC3FB681 FOREIGN KEY (domain_id_id) REFERENCES domain (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidacy DROP FOREIGN KEY FK_D930569D336C542C');
        $this->addSql('ALTER TABLE candidacy DROP FOREIGN KEY FK_D930569DFC69E3BE');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EAC3FB681');
        $this->addSql('DROP TABLE candidacy');
        $this->addSql('DROP TABLE offer');
    }
}
