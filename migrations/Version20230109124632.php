<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109124632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar ADD pallets_number INT DEFAULT NULL, ADD building VARCHAR(255) DEFAULT NULL, ADD supplier VARCHAR(255) DEFAULT NULL, ADD customer VARCHAR(255) DEFAULT NULL, ADD driver VARCHAR(255) DEFAULT NULL, ADD merchandise VARCHAR(255) DEFAULT NULL, ADD comment VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar DROP pallets_number, DROP building, DROP supplier, DROP customer, DROP driver, DROP merchandise, DROP comment');
    }
}
