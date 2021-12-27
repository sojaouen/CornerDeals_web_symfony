<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211227124522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deal ADD description VARCHAR(255) DEFAULT NULL, ADD url VARCHAR(255) NOT NULL, ADD discount_code VARCHAR(255) DEFAULT NULL, ADD discount_type VARCHAR(255) NOT NULL, ADD currency_type VARCHAR(10) NOT NULL, ADD start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD shipping_cost DOUBLE PRECISION DEFAULT NULL, ADD is_free_shipping TINYINT(1) NOT NULL, ADD shipping_country VARCHAR(50) NOT NULL, ADD is_local TINYINT(1) NOT NULL, ADD localities LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deal DROP description, DROP url, DROP discount_code, DROP discount_type, DROP currency_type, DROP start_at, DROP end_at, DROP shipping_cost, DROP is_free_shipping, DROP shipping_country, DROP is_local, DROP localities');
    }
}
