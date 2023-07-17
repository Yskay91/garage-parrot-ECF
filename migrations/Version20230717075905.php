<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717075905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hours CHANGE morning_open_hours morning_open_hours VARCHAR(255) NOT NULL, CHANGE morning_close_hours morning_close_hours VARCHAR(255) NOT NULL, CHANGE afternoon_open_hours afternoon_open_hours VARCHAR(255) NOT NULL, CHANGE afternoon_close_hours afternoon_close_hours VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hours CHANGE morning_open_hours morning_open_hours TIME NOT NULL, CHANGE morning_close_hours morning_close_hours TIME NOT NULL, CHANGE afternoon_open_hours afternoon_open_hours TIME NOT NULL, CHANGE afternoon_close_hours afternoon_close_hours TIME NOT NULL');
    }
}
