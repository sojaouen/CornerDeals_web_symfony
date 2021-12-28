<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228162658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deal_category (deal_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_E5CB085BF60E2305 (deal_id), INDEX IDX_E5CB085B12469DE2 (category_id), PRIMARY KEY(deal_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount_code_product (discount_code_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C3AD895B91D29306 (discount_code_id), INDEX IDX_C3AD895B4584665A (product_id), PRIMARY KEY(discount_code_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount_code_category (discount_code_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_5282A96591D29306 (discount_code_id), INDEX IDX_5282A96512469DE2 (category_id), PRIMARY KEY(discount_code_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_deal (product_id INT NOT NULL, deal_id INT NOT NULL, INDEX IDX_6E16E3B74584665A (product_id), INDEX IDX_6E16E3B7F60E2305 (deal_id), PRIMARY KEY(product_id, deal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deal_category ADD CONSTRAINT FK_E5CB085BF60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deal_category ADD CONSTRAINT FK_E5CB085B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discount_code_product ADD CONSTRAINT FK_C3AD895B91D29306 FOREIGN KEY (discount_code_id) REFERENCES discount_code (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discount_code_product ADD CONSTRAINT FK_C3AD895B4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discount_code_category ADD CONSTRAINT FK_5282A96591D29306 FOREIGN KEY (discount_code_id) REFERENCES discount_code (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discount_code_category ADD CONSTRAINT FK_5282A96512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_deal ADD CONSTRAINT FK_6E16E3B74584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_deal ADD CONSTRAINT FK_6E16E3B7F60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC11612469DE2');
        $this->addSql('DROP INDEX IDX_E3FEC11612469DE2 ON deal');
        $this->addSql('ALTER TABLE deal CHANGE category_id merchant_id INT NOT NULL');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1166796D554 FOREIGN KEY (merchant_id) REFERENCES merchant (id)');
        $this->addSql('CREATE INDEX IDX_E3FEC1166796D554 ON deal (merchant_id)');
        $this->addSql('ALTER TABLE discount_code ADD merchant_id INT NOT NULL');
        $this->addSql('ALTER TABLE discount_code ADD CONSTRAINT FK_E99735226796D554 FOREIGN KEY (merchant_id) REFERENCES merchant (id)');
        $this->addSql('CREATE INDEX IDX_E99735226796D554 ON discount_code (merchant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE deal_category');
        $this->addSql('DROP TABLE discount_code_product');
        $this->addSql('DROP TABLE discount_code_category');
        $this->addSql('DROP TABLE product_deal');
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC1166796D554');
        $this->addSql('DROP INDEX IDX_E3FEC1166796D554 ON deal');
        $this->addSql('ALTER TABLE deal CHANGE merchant_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC11612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_E3FEC11612469DE2 ON deal (category_id)');
        $this->addSql('ALTER TABLE discount_code DROP FOREIGN KEY FK_E99735226796D554');
        $this->addSql('DROP INDEX IDX_E99735226796D554 ON discount_code');
        $this->addSql('ALTER TABLE discount_code DROP merchant_id');
    }
}
