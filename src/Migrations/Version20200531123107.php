<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200531123107 extends AbstractMigration
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
        $this->addSql('ALTER TABLE comentaire ADD ville_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comentaire ADD CONSTRAINT FK_12018917A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE comentaire ADD CONSTRAINT FK_12018917A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_12018917A73F0036 ON comentaire (ville_id)');
        $this->addSql('CREATE INDEX IDX_12018917A76ED395 ON comentaire (user_id)');
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
        $this->addSql('ALTER TABLE comentaire DROP FOREIGN KEY FK_12018917A73F0036');
        $this->addSql('ALTER TABLE comentaire DROP FOREIGN KEY FK_12018917A76ED395');
        $this->addSql('DROP INDEX IDX_12018917A73F0036 ON comentaire');
        $this->addSql('DROP INDEX IDX_12018917A76ED395 ON comentaire');
        $this->addSql('ALTER TABLE comentaire DROP ville_id, DROP user_id');
        $this->addSql('ALTER TABLE hotel CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marker CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE resto CHANGE ville_id ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE tel tel VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ville CHANGE region_id region_id INT DEFAULT NULL');
    }
}
