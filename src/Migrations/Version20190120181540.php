<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190120181540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {

        $this->addSql('ALTER TABLE `users` 
                           ADD UNIQUE INDEX `username_UNIQUE` (`username` ASC)');
        $this->addSql('ALTER TABLE `products` 
                           ADD UNIQUE INDEX `asin_UNIQUE` (`asin` ASC)');
        $this->addSql('ALTER TABLE `categories` 
                           ADD UNIQUE INDEX `title_UNIQUE` (`title` ASC)');


    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
