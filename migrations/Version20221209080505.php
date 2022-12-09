<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209080505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enfant ADD responsable_id INT NOT NULL');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA253C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id)');
        $this->addSql('CREATE INDEX IDX_34B70CA253C59D72 ON enfant (responsable_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA253C59D72');
        $this->addSql('DROP INDEX IDX_34B70CA253C59D72 ON enfant');
        $this->addSql('ALTER TABLE enfant DROP responsable_id');
    }
}
