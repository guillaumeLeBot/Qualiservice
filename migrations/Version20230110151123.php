<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110151123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar ADD driver_id INT DEFAULT NULL, ADD building_id INT DEFAULT NULL, ADD supplier_id INT DEFAULT NULL, ADD customer_id INT DEFAULT NULL, ADD mode_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146C3423909 FOREIGN KEY (driver_id) REFERENCES drivers (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1464D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1462ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1469395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A14677E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('CREATE INDEX IDX_6EA9A146C3423909 ON calendar (driver_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A1464D2A7E12 ON calendar (building_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A1462ADD6D8C ON calendar (supplier_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A1469395C3F3 ON calendar (customer_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A14677E5854A ON calendar (mode_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146C3423909');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1464D2A7E12');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1462ADD6D8C');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1469395C3F3');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A14677E5854A');
        $this->addSql('DROP INDEX IDX_6EA9A146C3423909 ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A1464D2A7E12 ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A1462ADD6D8C ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A1469395C3F3 ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A14677E5854A ON calendar');
        $this->addSql('ALTER TABLE calendar DROP driver_id, DROP building_id, DROP supplier_id, DROP customer_id, DROP mode_id');
    }
}
