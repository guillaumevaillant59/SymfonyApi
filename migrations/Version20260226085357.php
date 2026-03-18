<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260226085357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY `FK_C53D045F4584665A`');
        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE category ADD description LONGTEXT DEFAULT NULL, ADD updated_at DATETIME NOT NULL, DROP descritpion, CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD category_id INT DEFAULT NULL, DROP image_name, DROP updated_at');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, updated_at DATETIME NOT NULL, product_id INT DEFAULT NULL, INDEX IDX_C53D045F4584665A (product_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT `FK_C53D045F4584665A` FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE category ADD descritpion LONGTEXT NOT NULL, DROP description, DROP updated_at, CHANGE image_name image_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('ALTER TABLE product ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME NOT NULL, DROP category_id');
    }
}
