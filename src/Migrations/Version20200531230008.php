<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200531230008 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite ADD updated_at DATETIME DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camping ADD updated_at DATETIME DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel ADD updated_at DATETIME DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marker DROP FOREIGN KEY FK_82CF20FEA73F0036');
        $this->addSql('ALTER TABLE marker CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marker ADD CONSTRAINT FK_82CF20FEA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE resto ADD updated_at DATETIME DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE tel tel VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE ville ADD updated_at DATETIME DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, CHANGE region_id region_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP updated_at, DROP created_at, CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camping DROP updated_at, DROP created_at, CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel DROP updated_at, DROP created_at, CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marker DROP FOREIGN KEY FK_82CF20FEA73F0036');
        $this->addSql('ALTER TABLE marker CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marker ADD CONSTRAINT FK_82CF20FEA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE resto DROP updated_at, DROP created_at, CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE tel tel VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ville DROP updated_at, DROP created_at, CHANGE region_id region_id INT DEFAULT NULL');
    }
}
