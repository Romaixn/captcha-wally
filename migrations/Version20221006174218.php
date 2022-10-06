<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221006174218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE captcha (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, base_image VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE generated_image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, captcha_id INTEGER NOT NULL, image VARCHAR(255) NOT NULL, is_valid BOOLEAN NOT NULL, CONSTRAINT FK_6E67FC401B8DEA76 FOREIGN KEY (captcha_id) REFERENCES captcha (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6E67FC401B8DEA76 ON generated_image (captcha_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE captcha');
        $this->addSql('DROP TABLE generated_image');
    }
}
