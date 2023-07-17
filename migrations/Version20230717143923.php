<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717143923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messages ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id)');
        $this->addSql('CREATE INDEX IDX_DB021E96C3C6F69F ON messages (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96C3C6F69F');
        $this->addSql('DROP INDEX IDX_DB021E96C3C6F69F ON messages');
        $this->addSql('ALTER TABLE messages DROP car_id');
    }
}
