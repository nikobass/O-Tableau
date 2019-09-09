<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909073708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(65) NOT NULL, document_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D8698A76A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_student (document_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_134C09EFC33F7837 (document_id), INDEX IDX_134C09EFCB944F1A (student_id), PRIMARY KEY(document_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, username VARCHAR(65) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, postalcode VARCHAR(10) NOT NULL, city VARCHAR(100) NOT NULL, phone VARCHAR(20) DEFAULT NULL, mobile_phone VARCHAR(20) DEFAULT NULL, job_phone VARCHAR(20) DEFAULT NULL, communication_agreement TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8D93D649D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classroom (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, school_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_497D309DA76ED395 (user_id), INDEX IDX_497D309DC32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lunch_type (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(10) NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, is_worked TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alert (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_17FD46C1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE has_status (id INT AUTO_INCREMENT NOT NULL, calendar_id INT DEFAULT NULL, student_id INT DEFAULT NULL, is_present TINYINT(1) NOT NULL, is_ordered TINYINT(1) NOT NULL, is_canceled TINYINT(1) NOT NULL, has_eated TINYINT(1) NOT NULL, INDEX IDX_57227287A40A2C8 (calendar_id), INDEX IDX_57227287CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actuality (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, picture_url VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4093DDD8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, classroom_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, birthdate DATETIME NOT NULL, image VARCHAR(255) DEFAULT NULL, image_rights TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_B723AF336278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_user (student_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B2B0AD91CB944F1A (student_id), INDEX IDX_B2B0AD91A76ED395 (user_id), PRIMARY KEY(student_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_lunch_type (student_id INT NOT NULL, lunch_type_id INT NOT NULL, INDEX IDX_F3FB5E1ACB944F1A (student_id), INDEX IDX_F3FB5E1A2C3B40B5 (lunch_type_id), PRIMARY KEY(student_id, lunch_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_person (student_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_BAEA09F6CB944F1A (student_id), INDEX IDX_BAEA09F6217BBB47 (person_id), PRIMARY KEY(student_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE document_student ADD CONSTRAINT FK_134C09EFC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_student ADD CONSTRAINT FK_134C09EFCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE classroom ADD CONSTRAINT FK_497D309DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE classroom ADD CONSTRAINT FK_497D309DC32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE has_status ADD CONSTRAINT FK_57227287A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id)');
        $this->addSql('ALTER TABLE has_status ADD CONSTRAINT FK_57227287CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE actuality ADD CONSTRAINT FK_4093DDD8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF336278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('ALTER TABLE student_user ADD CONSTRAINT FK_B2B0AD91CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_user ADD CONSTRAINT FK_B2B0AD91A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_lunch_type ADD CONSTRAINT FK_F3FB5E1ACB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_lunch_type ADD CONSTRAINT FK_F3FB5E1A2C3B40B5 FOREIGN KEY (lunch_type_id) REFERENCES lunch_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_person ADD CONSTRAINT FK_BAEA09F6CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_person ADD CONSTRAINT FK_BAEA09F6217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE classroom DROP FOREIGN KEY FK_497D309DC32A47EE');
        $this->addSql('ALTER TABLE document_student DROP FOREIGN KEY FK_134C09EFC33F7837');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76A76ED395');
        $this->addSql('ALTER TABLE classroom DROP FOREIGN KEY FK_497D309DA76ED395');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1A76ED395');
        $this->addSql('ALTER TABLE actuality DROP FOREIGN KEY FK_4093DDD8A76ED395');
        $this->addSql('ALTER TABLE student_user DROP FOREIGN KEY FK_B2B0AD91A76ED395');
        $this->addSql('ALTER TABLE student_person DROP FOREIGN KEY FK_BAEA09F6217BBB47');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF336278D5A8');
        $this->addSql('ALTER TABLE student_lunch_type DROP FOREIGN KEY FK_F3FB5E1A2C3B40B5');
        $this->addSql('ALTER TABLE has_status DROP FOREIGN KEY FK_57227287A40A2C8');
        $this->addSql('ALTER TABLE document_student DROP FOREIGN KEY FK_134C09EFCB944F1A');
        $this->addSql('ALTER TABLE has_status DROP FOREIGN KEY FK_57227287CB944F1A');
        $this->addSql('ALTER TABLE student_user DROP FOREIGN KEY FK_B2B0AD91CB944F1A');
        $this->addSql('ALTER TABLE student_lunch_type DROP FOREIGN KEY FK_F3FB5E1ACB944F1A');
        $this->addSql('ALTER TABLE student_person DROP FOREIGN KEY FK_BAEA09F6CB944F1A');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_student');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE lunch_type');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE alert');
        $this->addSql('DROP TABLE has_status');
        $this->addSql('DROP TABLE actuality');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_user');
        $this->addSql('DROP TABLE student_lunch_type');
        $this->addSql('DROP TABLE student_person');
    }
}
