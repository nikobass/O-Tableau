<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190917152751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE actuality_classroom (actuality_id INT NOT NULL, classroom_id INT NOT NULL, INDEX IDX_486B3E38B84BD854 (actuality_id), INDEX IDX_486B3E386278D5A8 (classroom_id), PRIMARY KEY(actuality_id, classroom_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actuality_classroom ADD CONSTRAINT FK_486B3E38B84BD854 FOREIGN KEY (actuality_id) REFERENCES actuality (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actuality_classroom ADD CONSTRAINT FK_486B3E386278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calendar CHANGE date date VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE actuality_classroom');
        $this->addSql('ALTER TABLE calendar CHANGE date date DATETIME NOT NULL');
    }
}
