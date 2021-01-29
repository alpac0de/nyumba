<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210129194423 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create housing';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE housing (id VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, address TEXT NOT NULL, country VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN housing.created_at IS \'(DC2Type:datetimetz_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE housing');
    }
}
