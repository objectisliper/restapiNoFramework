<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190119221010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE `products_categories` 
                            ADD CONSTRAINT `fk_products`
                              FOREIGN KEY (`product_id`)
                              REFERENCES `products` (`id`)
                              ON DELETE CASCADE
                              ON UPDATE NO ACTION,
                            ADD CONSTRAINT `fk_categories`
                              FOREIGN KEY (`category_id`)
                              REFERENCES `categories` (`id`)
                              ON DELETE CASCADE 
                              ON UPDATE NO ACTION;');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
