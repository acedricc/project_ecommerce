<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927124507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coupons DROP FOREIGN KEY FK_F564111897316D65');
        $this->addSql('DROP INDEX IDX_F564111897316D65 ON coupons');
        $this->addSql('ALTER TABLE coupons CHANGE coupon_types_id coupons_types_id INT NOT NULL');
        $this->addSql('ALTER TABLE coupons ADD CONSTRAINT FK_F56411183DDD47B7 FOREIGN KEY (coupons_types_id) REFERENCES coupon_types (id)');
        $this->addSql('CREATE INDEX IDX_F56411183DDD47B7 ON coupons (coupons_types_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coupons DROP FOREIGN KEY FK_F56411183DDD47B7');
        $this->addSql('DROP INDEX IDX_F56411183DDD47B7 ON coupons');
        $this->addSql('ALTER TABLE coupons CHANGE coupons_types_id coupon_types_id INT NOT NULL');
        $this->addSql('ALTER TABLE coupons ADD CONSTRAINT FK_F564111897316D65 FOREIGN KEY (coupon_types_id) REFERENCES coupon_types (id)');
        $this->addSql('CREATE INDEX IDX_F564111897316D65 ON coupons (coupon_types_id)');
    }
}
