<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504074622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, author, message FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, book_id INTEGER NOT NULL, author VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, CONSTRAINT FK_9474526C16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment (id, author, message) SELECT id, author, message FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C16A2B381 ON comment (book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_9474526C16A2B381');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, author, message FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO comment (id, author, message) SELECT id, author, message FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
    }
}
