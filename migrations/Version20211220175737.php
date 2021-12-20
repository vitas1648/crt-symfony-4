<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211220175737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE pizza_ingredients_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
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
        $this->addSql('DROP SEQUENCE pizza_ingredients_id_seq CASCADE');
        $this->addSql('DROP TABLE pizza_ingredients');
    }
}
