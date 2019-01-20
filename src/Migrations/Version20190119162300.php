<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190119162300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create categories, product, products_categories, users table.';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, sku VARCHAR(255) NOT NULL, asin VARCHAR(255) DEFAULT NULL , PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE products_categories (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE `products_categories` ADD INDEX `fk_pc_1_idx` (`product_id` ASC)');
        $this->addSql('ALTER TABLE `products_categories` ADD INDEX `fk_pc_2_idx` (`category_id` ASC)');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE products_categories');
        $this->addSql('DROP TABLE users');

    }
}
