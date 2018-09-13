<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180913195638 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('sqlite' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE "match" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player_one_id INTEGER NOT NULL, player_two_id INTEGER NOT NULL, winner_id INTEGER DEFAULT NULL, player_one_score INTEGER NOT NULL, player_two_score INTEGER NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_7A5BC505649A58CD ON "match" (player_one_id)');
        $this->addSql('CREATE INDEX IDX_7A5BC505FC6BF02 ON "match" (player_two_id)');
        $this->addSql('CREATE INDEX IDX_7A5BC5055DFCD4B8 ON "match" (winner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('sqlite' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE "match"');
    }
}
