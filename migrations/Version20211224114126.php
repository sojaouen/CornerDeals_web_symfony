<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211224114126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE color color CHAR(7) DEFAULT NULL');
        $this->addSql('ALTER TABLE deal ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC11612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_E3FEC11612469DE2 ON deal (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE color color VARCHAR(7) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC11612469DE2');
        $this->addSql('DROP INDEX IDX_E3FEC11612469DE2 ON deal');
        $this->addSql('ALTER TABLE deal DROP category_id');
    }
}
