<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211222100346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street_number VARCHAR(10) DEFAULT NULL, street_number_extension VARCHAR(20) DEFAULT NULL, street_type VARCHAR(25) DEFAULT NULL, street_name VARCHAR(100) DEFAULT NULL, building VARCHAR(80) DEFAULT NULL, establishment VARCHAR(80) DEFAULT NULL, floor VARCHAR(45) DEFAULT NULL, floor_number VARCHAR(10) DEFAULT NULL, postal_code VARCHAR(10) DEFAULT NULL, postal_code_prefix VARCHAR(10) DEFAULT NULL, postal_code_suffix VARCHAR(10) DEFAULT NULL, city VARCHAR(200) DEFAULT NULL, cedex VARCHAR(10) DEFAULT NULL, post_box_code VARCHAR(10) DEFAULT NULL, locality VARCHAR(200) DEFAULT NULL, adminitrative_area_level1 VARCHAR(80) DEFAULT NULL, adminitrative_area_level2 VARCHAR(80) DEFAULT NULL, adminitrative_area_level3 VARCHAR(80) DEFAULT NULL, adminitrative_area_level4 VARCHAR(80) DEFAULT NULL, adminitrative_area_level5 VARCHAR(80) DEFAULT NULL, country VARCHAR(3) DEFAULT NULL, latitude VARCHAR(80) DEFAULT NULL, longitude VARCHAR(80) DEFAULT NULL, altitude VARCHAR(10) DEFAULT NULL, is_flat TINYINT(1) NOT NULL, has_elevator TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, color VARCHAR(7) DEFAULT NULL, illustration VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, comment_text VARCHAR(255) DEFAULT NULL, creation_date DATETIME NOT NULL, update_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, crossed_out_price DOUBLE PRECISION NOT NULL, deal_price DOUBLE PRECISION NOT NULL, discount DOUBLE PRECISION NOT NULL, discount_unity VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal_comment (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, comment LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount_code (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount_code_comment (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, comment LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE merchant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(40) NOT NULL, lastname VARCHAR(40) NOT NULL, birthdate DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE deal');
        $this->addSql('DROP TABLE deal_comment');
        $this->addSql('DROP TABLE discount_code');
        $this->addSql('DROP TABLE discount_code_comment');
        $this->addSql('DROP TABLE merchant');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
    }
}
