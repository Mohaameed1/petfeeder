<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220226001234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE servetime DROP FOREIGN KEY FK_EA2D5DB67B3B43D');
        $this->addSql('DROP INDEX IDX_EA2D5DB67B3B43D ON servetime');
        $this->addSql('ALTER TABLE servetime DROP users_id, DROP azerty');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE servetime ADD users_id INT DEFAULT NULL, ADD azerty VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE servetime ADD CONSTRAINT FK_EA2D5DB67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EA2D5DB67B3B43D ON servetime (users_id)');
    }
}
