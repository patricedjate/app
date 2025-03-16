<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231225005312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent_visite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, nombre_dossier INT NOT NULL, test VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cda_id INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, nom_cda VARCHAR(255) NOT NULL, nom_exportateur VARCHAR(255) NOT NULL, nature_marchandise VARCHAR(255) NOT NULL, colis_marchandise VARCHAR(255) NOT NULL, poids_net_marchandise VARCHAR(255) NOT NULL, conditionnement_marchandise VARCHAR(255) NOT NULL, lieu_empotage_marchandise VARCHAR(255) NOT NULL, nconteneurs VARCHAR(255) NOT NULL, type_tc VARCHAR(255) NOT NULL, nplombs VARCHAR(255) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', statut TINYINT(1) NOT NULL, INDEX IDX_4C13CC78A76ED395 (user_id), INDEX IDX_4C13CC78498A819E (cda_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport_empotage (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, fiche_id INT DEFAULT NULL, contenu VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_69E4AF27A76ED395 (user_id), UNIQUE INDEX UNIQ_69E4AF27DF522508 (fiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', nombre_dossier INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, lieu VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78498A819E FOREIGN KEY (cda_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rapport_empotage ADD CONSTRAINT FK_69E4AF27A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rapport_empotage ADD CONSTRAINT FK_69E4AF27DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78A76ED395');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78498A819E');
        $this->addSql('ALTER TABLE rapport_empotage DROP FOREIGN KEY FK_69E4AF27A76ED395');
        $this->addSql('ALTER TABLE rapport_empotage DROP FOREIGN KEY FK_69E4AF27DF522508');
        $this->addSql('DROP TABLE agent_visite');
        $this->addSql('DROP TABLE fiche');
        $this->addSql('DROP TABLE rapport_empotage');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE visite');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
