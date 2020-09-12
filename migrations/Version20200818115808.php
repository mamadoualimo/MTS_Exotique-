<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200818115808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_shipping_adress (user_id INT NOT NULL, shipping_adress_id INT NOT NULL, INDEX IDX_656A6E7EA76ED395 (user_id), INDEX IDX_656A6E7EC273A89B (shipping_adress_id), PRIMARY KEY(user_id, shipping_adress_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_shipping_adress ADD CONSTRAINT FK_656A6E7EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_shipping_adress ADD CONSTRAINT FK_656A6E7EC273A89B FOREIGN KEY (shipping_adress_id) REFERENCES shipping_adress (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE utilisateur_shipping_adress');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0C6EE5C49');
        $this->addSql('DROP INDEX idx_8f91abf0c6ee5c49 ON avis');
        $this->addSql('CREATE INDEX IDX_8F91ABF079F37AE5 ON avis (id_user_id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0C6EE5C49 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DC6EE5C49');
        $this->addSql('DROP INDEX idx_6eeaa67dc6ee5c49 ON commande');
        $this->addSql('CREATE INDEX IDX_6EEAA67D79F37AE5 ON commande (id_user_id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DC6EE5C49 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD phone_number VARCHAR(255) NOT NULL, DROP nom, DROP prenom, DROP telephone, DROP mot_pass, DROP role, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_shipping_adress (utilisateur_id INT NOT NULL, shipping_adress_id INT NOT NULL, INDEX IDX_626FBD87C273A89B (shipping_adress_id), INDEX IDX_626FBD87FB88E14F (utilisateur_id), PRIMARY KEY(utilisateur_id, shipping_adress_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur_shipping_adress ADD CONSTRAINT FK_626FBD87C273A89B FOREIGN KEY (shipping_adress_id) REFERENCES shipping_adress (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_shipping_adress ADD CONSTRAINT FK_626FBD87FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_shipping_adress');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF079F37AE5');
        $this->addSql('DROP INDEX idx_8f91abf079f37ae5 ON avis');
        $this->addSql('CREATE INDEX IDX_8F91ABF0C6EE5C49 ON avis (id_user_id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF079F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D79F37AE5');
        $this->addSql('DROP INDEX idx_6eeaa67d79f37ae5 ON commande');
        $this->addSql('CREATE INDEX IDX_6EEAA67DC6EE5C49 ON commande (id_user_id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD mot_pass VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP roles, DROP password, DROP first_name, DROP last_name, DROP phone_number, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
