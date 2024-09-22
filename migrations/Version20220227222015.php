<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220227222015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE systeme CHANGE nv_stock nv_stock VARCHAR(255) NOT NULL, CHANGE nv_eau nv_eau VARCHAR(255) NOT NULL, CHANGE seuil_stock seuil_stock VARCHAR(255) NOT NULL, CHANGE seuil_eau seuil_eau VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE systeme CHANGE nv_stock nv_stock DOUBLE PRECISION NOT NULL, CHANGE nv_eau nv_eau DOUBLE PRECISION NOT NULL, CHANGE seuil_stock seuil_stock DOUBLE PRECISION NOT NULL, CHANGE seuil_eau seuil_eau DOUBLE PRECISION NOT NULL');
    }
}
