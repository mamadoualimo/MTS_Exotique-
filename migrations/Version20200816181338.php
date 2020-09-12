<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200816181338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_produit_id INT NOT NULL, description VARCHAR(255) NOT NULL, date_pub DATE NOT NULL, evaluation VARCHAR(255) NOT NULL, INDEX IDX_8F91ABF0C6EE5C49 (id_utilisateur_id), INDEX IDX_8F91ABF0AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, statut VARCHAR(255) NOT NULL, date_com DATE NOT NULL, INDEX IDX_6EEAA67DC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, id_com_id INT NOT NULL, date_fact DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_FE86641052BBBADA (id_com_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_com (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT NOT NULL, qte INT NOT NULL, INDEX IDX_B65E39F2AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, id_com_id INT NOT NULL, date_liv DATE NOT NULL, INDEX IDX_A60C9F1F52BBBADA (id_com_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, no_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, qte_stock VARCHAR(255) NOT NULL, INDEX IDX_29A5EC271A65C546 (no_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipping_adress (id INT AUTO_INCREMENT NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, mot_pass VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_shipping_adress (utilisateur_id INT NOT NULL, shipping_adress_id INT NOT NULL, INDEX IDX_626FBD87FB88E14F (utilisateur_id), INDEX IDX_626FBD87C273A89B (shipping_adress_id), PRIMARY KEY(utilisateur_id, shipping_adress_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641052BBBADA FOREIGN KEY (id_com_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_com ADD CONSTRAINT FK_B65E39F2AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F52BBBADA FOREIGN KEY (id_com_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC271A65C546 FOREIGN KEY (no_id) REFERENCES ligne_com (id)');
        $this->addSql('ALTER TABLE utilisateur_shipping_adress ADD CONSTRAINT FK_626FBD87FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_shipping_adress ADD CONSTRAINT FK_626FBD87C273A89B FOREIGN KEY (shipping_adress_id) REFERENCES shipping_adress (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641052BBBADA');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F52BBBADA');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC271A65C546');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0AABEFE2C');
        $this->addSql('ALTER TABLE ligne_com DROP FOREIGN KEY FK_B65E39F2AABEFE2C');
        $this->addSql('ALTER TABLE utilisateur_shipping_adress DROP FOREIGN KEY FK_626FBD87C273A89B');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0C6EE5C49');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DC6EE5C49');
        $this->addSql('ALTER TABLE utilisateur_shipping_adress DROP FOREIGN KEY FK_626FBD87FB88E14F');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE ligne_com');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE shipping_adress');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_shipping_adress');
    }
}
