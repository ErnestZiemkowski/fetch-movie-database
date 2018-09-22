<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180922201412 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE movie_rating (id INT AUTO_INCREMENT NOT NULL, movie_id INT DEFAULT NULL, rating_id INT DEFAULT NULL, value VARCHAR(15) NOT NULL, INDEX IDX_214EBB578F93B6FC (movie_id), INDEX IDX_214EBB57A32EFC6 (rating_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_rating ADD CONSTRAINT FK_214EBB578F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie_rating ADD CONSTRAINT FK_214EBB57A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE movie_rating');
    }
}
