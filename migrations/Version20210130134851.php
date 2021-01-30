<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210130134851 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add media';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE media (id VARCHAR(255) NOT NULL, advert_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, path VARCHAR(255) NOT NULL, options JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2CA10CD07ECCB6 ON media (advert_id)');
        $this->addSql('COMMENT ON COLUMN media.created_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CD07ECCB6 FOREIGN KEY (advert_id) REFERENCES advert (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE media');
    }
}
