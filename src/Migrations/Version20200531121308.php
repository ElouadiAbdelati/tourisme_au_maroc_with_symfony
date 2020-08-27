<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200531121308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camping CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marker CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE resto CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE tel tel VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE ville CHANGE region_id region_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camping CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marker CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE resto CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE tel tel VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ville CHANGE region_id region_id INT DEFAULT NULL');
    }
}
