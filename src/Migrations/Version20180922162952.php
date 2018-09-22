<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180922162952 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, year DATE DEFAULT NULL, rated VARCHAR(10) DEFAULT NULL, released DATE DEFAULT NULL, runtime VARCHAR(10) DEFAULT NULL, plot VARCHAR(1000) DEFAULT NULL, awards VARCHAR(50) DEFAULT NULL, poster_url VARCHAR(300) DEFAULT NULL, metascore INT DEFAULT NULL, imdb_rating DOUBLE PRECISION DEFAULT NULL, imdb_votes INT DEFAULT NULL, imdb_id VARCHAR(15) DEFAULT NULL, type VARCHAR(15) DEFAULT NULL, dvd DATE DEFAULT NULL, box_office VARCHAR(10) DEFAULT NULL, production VARCHAR(50) DEFAULT NULL, website_url VARCHAR(300) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies_genres (movie_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_DF9737A28F93B6FC (movie_id), INDEX IDX_DF9737A24296D31F (genre_id), PRIMARY KEY(movie_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, language VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE writer (id INT AUTO_INCREMENT NOT NULL, writer VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, source VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE director (id INT AUTO_INCREMENT NOT NULL, director VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movies_genres ADD CONSTRAINT FK_DF9737A28F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_genres ADD CONSTRAINT FK_DF9737A24296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE movies_genres DROP FOREIGN KEY FK_DF9737A28F93B6FC');
        $this->addSql('ALTER TABLE movies_genres DROP FOREIGN KEY FK_DF9737A24296D31F');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movies_genres');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE writer');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE director');
        $this->addSql('DROP TABLE country');
    }
}
