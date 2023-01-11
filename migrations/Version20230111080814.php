<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111080814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE building (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calendar ADD customer_id INT DEFAULT NULL, ADD supplier_id INT DEFAULT NULL, ADD driver_id INT DEFAULT NULL, ADD building_id INT DEFAULT NULL, ADD pallets_number INT DEFAULT NULL, ADD merchandise VARCHAR(255) DEFAULT NULL, ADD comment VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE all_day all_day TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1469395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1462ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1464D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
        $this->addSql('CREATE INDEX IDX_6EA9A1469395C3F3 ON calendar (customer_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A1462ADD6D8C ON calendar (supplier_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A146C3423909 ON calendar (driver_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A1464D2A7E12 ON calendar (building_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1464D2A7E12');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1469395C3F3');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146C3423909');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1462ADD6D8C');
        $this->addSql('DROP TABLE building');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP INDEX IDX_6EA9A1469395C3F3 ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A1462ADD6D8C ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A146C3423909 ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A1464D2A7E12 ON calendar');
        $this->addSql('ALTER TABLE calendar DROP customer_id, DROP supplier_id, DROP driver_id, DROP building_id, DROP pallets_number, DROP merchandise, DROP comment, CHANGE description description VARCHAR(255) NOT NULL, CHANGE all_day all_day TINYINT(1) NOT NULL');
    }
}
