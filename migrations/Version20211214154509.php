<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214154509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street_number VARCHAR(10) DEFAULT NULL, street_number_extension VARCHAR(20) DEFAULT NULL, street_type VARCHAR(25) DEFAULT NULL, street_name VARCHAR(100) DEFAULT NULL, building VARCHAR(80) DEFAULT NULL, establishment VARCHAR(80) DEFAULT NULL, floor VARCHAR(45) DEFAULT NULL, floor_number VARCHAR(10) DEFAULT NULL, postal_code VARCHAR(10) DEFAULT NULL, postal_code_prefix VARCHAR(10) DEFAULT NULL, postal_code_suffix VARCHAR(10) DEFAULT NULL, city VARCHAR(200) DEFAULT NULL, cedex VARCHAR(10) DEFAULT NULL, post_box_code VARCHAR(10) DEFAULT NULL, locality VARCHAR(200) DEFAULT NULL, adminitrative_area_level1 VARCHAR(80) DEFAULT NULL, adminitrative_area_level2 VARCHAR(80) DEFAULT NULL, adminitrative_area_level3 VARCHAR(80) DEFAULT NULL, adminitrative_area_level4 VARCHAR(80) DEFAULT NULL, adminitrative_area_level5 VARCHAR(80) DEFAULT NULL, country VARCHAR(3) DEFAULT NULL, latitude VARCHAR(80) DEFAULT NULL, longitude VARCHAR(80) DEFAULT NULL, altitude VARCHAR(10) DEFAULT NULL, is_flat TINYINT(1) NOT NULL, has_elevator TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE address');
    }
}
