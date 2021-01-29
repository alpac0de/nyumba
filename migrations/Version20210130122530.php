<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210130122530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create advert';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE advert (id VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, type VARCHAR(255) NOT NULL, address TEXT NOT NULL, country VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN advert.created_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE advert_translation (id VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE advert');
        $this->addSql('DROP TABLE advert_translation');
    }
}
