<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260226133109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD image_id INT DEFAULT NULL, DROP image_name, DROP updated_at');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C13DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C13DA5256D ON category (image_id)');
        $this->addSql('ALTER TABLE image CHANGE name name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C13DA5256D');
        $this->addSql('DROP INDEX UNIQ_64C19C13DA5256D ON category');
        $this->addSql('ALTER TABLE category ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME NOT NULL, DROP image_id');
        $this->addSql('ALTER TABLE image CHANGE name name VARCHAR(255) NOT NULL');
    }
}
