<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211222133848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pizza (id INT NOT NULL, image VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pizza_ingredients (id INT NOT NULL, pizza_id INT NOT NULL, ingredient_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AD0714F6D41D1D42 ON pizza_ingredients (pizza_id)');
        $this->addSql('CREATE INDEX IDX_AD0714F6933FE08C ON pizza_ingredients (ingredient_id)');
        $this->addSql('ALTER TABLE pizza_ingredients ADD CONSTRAINT FK_AD0714F6D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pizza_ingredients ADD CONSTRAINT FK_AD0714F6933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pizza_ingredients DROP CONSTRAINT FK_AD0714F6933FE08C');
        $this->addSql('ALTER TABLE pizza_ingredients DROP CONSTRAINT FK_AD0714F6D41D1D42');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE pizza');
        $this->addSql('DROP TABLE pizza_ingredients');
    }
}
