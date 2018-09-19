<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180919182714 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE player_rating (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, value INT NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_4789B0FC99E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, player_one_id INT NOT NULL, player_two_id INT NOT NULL, winner_id INT DEFAULT NULL, player_one_score INT NOT NULL, player_two_score INT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME NOT NULL, INDEX IDX_7A5BC505649A58CD (player_one_id), INDEX IDX_7A5BC505FC6BF02 (player_two_id), INDEX IDX_7A5BC5055DFCD4B8 (winner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player_rating ADD CONSTRAINT FK_4789B0FC99E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505649A58CD FOREIGN KEY (player_one_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505FC6BF02 FOREIGN KEY (player_two_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC5055DFCD4B8 FOREIGN KEY (winner_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player_rating DROP FOREIGN KEY FK_4789B0FC99E6F5DF');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505649A58CD');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505FC6BF02');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC5055DFCD4B8');
        $this->addSql('DROP TABLE player_rating');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE `match`');
    }
}
