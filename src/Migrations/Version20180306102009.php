<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180306102009 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, path VARCHAR(250) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_876E0D95E237E06 (name), UNIQUE INDEX UNIQ_876E0D9B548B0F (path), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_tag (photo_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_8C2D8E577E9E4C8C (photo_id), INDEX IDX_8C2D8E57BAD26311 (tag_id), PRIMARY KEY(photo_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, password VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo_tag ADD CONSTRAINT FK_8C2D8E577E9E4C8C FOREIGN KEY (photo_id) REFERENCES photos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo_tag ADD CONSTRAINT FK_8C2D8E57BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photo_tag DROP FOREIGN KEY FK_8C2D8E577E9E4C8C');
        $this->addSql('ALTER TABLE photo_tag DROP FOREIGN KEY FK_8C2D8E57BAD26311');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE photo_tag');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE users');
    }
}
