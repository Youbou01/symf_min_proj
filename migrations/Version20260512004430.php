<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260512004430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add peinture relation to commentaire';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE commentaire ADD peinture_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_67F068BCB3B6D9B3 ON commentaire (peinture_id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB3B6D9B3 FOREIGN KEY (peinture_id) REFERENCES peinture (id) NOT DEFERRABLE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BCB3B6D9B3');
        $this->addSql('DROP INDEX IDX_67F068BCB3B6D9B3');
        $this->addSql('ALTER TABLE commentaire DROP peinture_id');
    }
}
