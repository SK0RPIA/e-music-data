<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221117084044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responsable ADD is_verified TINYINT(1) NOT NULL, ADD nom VARCHAR(32) NOT NULL, ADD prenom VARCHAR(32) NOT NULL, ADD date_naiss DATETIME NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, ADD nom VARCHAR(32) NOT NULL, ADD prenom VARCHAR(32) NOT NULL, ADD date_naiss DATETIME NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responsable DROP is_verified, DROP nom, DROP prenom, DROP date_naiss, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE user DROP is_verified, DROP nom, DROP prenom, DROP date_naiss, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
