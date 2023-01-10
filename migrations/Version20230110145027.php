<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110145027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE building (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE building_calendar (building_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_B525A01D4D2A7E12 (building_id), INDEX IDX_B525A01DA40A2C8 (calendar_id), PRIMARY KEY(building_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_calendar (customer_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_426CE2699395C3F3 (customer_id), INDEX IDX_426CE269A40A2C8 (calendar_id), PRIMARY KEY(customer_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drivers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drivers_calendar (drivers_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_3A2A0C619E6E47B8 (drivers_id), INDEX IDX_3A2A0C61A40A2C8 (calendar_id), PRIMARY KEY(drivers_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_calendar (mode_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_6DCED5DD77E5854A (mode_id), INDEX IDX_6DCED5DDA40A2C8 (calendar_id), PRIMARY KEY(mode_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier_calendar (supplier_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_E320C9C72ADD6D8C (supplier_id), INDEX IDX_E320C9C7A40A2C8 (calendar_id), PRIMARY KEY(supplier_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE building_calendar ADD CONSTRAINT FK_B525A01D4D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE building_calendar ADD CONSTRAINT FK_B525A01DA40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_calendar ADD CONSTRAINT FK_426CE2699395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_calendar ADD CONSTRAINT FK_426CE269A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE drivers_calendar ADD CONSTRAINT FK_3A2A0C619E6E47B8 FOREIGN KEY (drivers_id) REFERENCES drivers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE drivers_calendar ADD CONSTRAINT FK_3A2A0C61A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mode_calendar ADD CONSTRAINT FK_6DCED5DD77E5854A FOREIGN KEY (mode_id) REFERENCES mode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mode_calendar ADD CONSTRAINT FK_6DCED5DDA40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE supplier_calendar ADD CONSTRAINT FK_E320C9C72ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE supplier_calendar ADD CONSTRAINT FK_E320C9C7A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calendar DROP building, DROP supplier, DROP customer, DROP driver');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE building_calendar DROP FOREIGN KEY FK_B525A01D4D2A7E12');
        $this->addSql('ALTER TABLE building_calendar DROP FOREIGN KEY FK_B525A01DA40A2C8');
        $this->addSql('ALTER TABLE customer_calendar DROP FOREIGN KEY FK_426CE2699395C3F3');
        $this->addSql('ALTER TABLE customer_calendar DROP FOREIGN KEY FK_426CE269A40A2C8');
        $this->addSql('ALTER TABLE drivers_calendar DROP FOREIGN KEY FK_3A2A0C619E6E47B8');
        $this->addSql('ALTER TABLE drivers_calendar DROP FOREIGN KEY FK_3A2A0C61A40A2C8');
        $this->addSql('ALTER TABLE mode_calendar DROP FOREIGN KEY FK_6DCED5DD77E5854A');
        $this->addSql('ALTER TABLE mode_calendar DROP FOREIGN KEY FK_6DCED5DDA40A2C8');
        $this->addSql('ALTER TABLE supplier_calendar DROP FOREIGN KEY FK_E320C9C72ADD6D8C');
        $this->addSql('ALTER TABLE supplier_calendar DROP FOREIGN KEY FK_E320C9C7A40A2C8');
        $this->addSql('DROP TABLE building');
        $this->addSql('DROP TABLE building_calendar');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_calendar');
        $this->addSql('DROP TABLE drivers');
        $this->addSql('DROP TABLE drivers_calendar');
        $this->addSql('DROP TABLE mode');
        $this->addSql('DROP TABLE mode_calendar');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE supplier_calendar');
        $this->addSql('ALTER TABLE calendar ADD building VARCHAR(255) DEFAULT NULL, ADD supplier VARCHAR(255) DEFAULT NULL, ADD customer VARCHAR(255) DEFAULT NULL, ADD driver VARCHAR(255) DEFAULT NULL');
    }
}
