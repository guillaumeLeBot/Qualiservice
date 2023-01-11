<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111115848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146A69781E8');
        $this->addSql('DROP INDEX IDX_6EA9A146A69781E8 ON calendar');
        $this->addSql('ALTER TABLE calendar DROP trucks_schedule_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar ADD trucks_schedule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146A69781E8 FOREIGN KEY (trucks_schedule_id) REFERENCES trucks_schedule (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6EA9A146A69781E8 ON calendar (trucks_schedule_id)');
    }
}
