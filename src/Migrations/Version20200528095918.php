<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200528095918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comentaire (id INT AUTO_INCREMENT NOT NULL, comentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_voyage (id INT AUTO_INCREMENT NOT NULL, type_voyage VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515474460EB');
        $this->addSql('DROP INDEX UNIQ_B8755515474460EB ON activite');
        $this->addSql('ALTER TABLE activite ADD ville_id INT DEFAULT NULL, DROP marker_id');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_B8755515A73F0036 ON activite (ville_id)');
        $this->addSql('ALTER TABLE camping DROP FOREIGN KEY FK_81A904E4474460EB');
        $this->addSql('DROP INDEX UNIQ_81A904E4474460EB ON camping');
        $this->addSql('ALTER TABLE camping ADD ville_id INT DEFAULT NULL, DROP marker_id');
        $this->addSql('ALTER TABLE camping ADD CONSTRAINT FK_81A904E4A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_81A904E4A73F0036 ON camping (ville_id)');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED9474460EB');
        $this->addSql('DROP INDEX UNIQ_3535ED9474460EB ON hotel');
        $this->addSql('ALTER TABLE hotel ADD ville_id INT DEFAULT NULL, DROP marker_id');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED9A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_3535ED9A73F0036 ON hotel (ville_id)');
        $this->addSql('ALTER TABLE marker ADD ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marker ADD CONSTRAINT FK_82CF20FEA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_82CF20FEA73F0036 ON marker (ville_id)');
        $this->addSql('ALTER TABLE resto DROP FOREIGN KEY FK_892155B1474460EB');
        $this->addSql('DROP INDEX UNIQ_892155B1474460EB ON resto');
        $this->addSql('ALTER TABLE resto ADD ville_id INT DEFAULT NULL, DROP marker_id');
        $this->addSql('ALTER TABLE resto ADD CONSTRAINT FK_892155B1A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_892155B1A73F0036 ON resto (ville_id)');
        $this->addSql('ALTER TABLE ville ADD region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C398260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_43C3D9C398260155 ON ville (region_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C398260155');
        $this->addSql('DROP TABLE comentaire');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE type_voyage');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515A73F0036');
        $this->addSql('DROP INDEX IDX_B8755515A73F0036 ON activite');
        $this->addSql('ALTER TABLE activite ADD marker_id INT DEFAULT NULL, DROP ville_id');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515474460EB FOREIGN KEY (marker_id) REFERENCES marker (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8755515474460EB ON activite (marker_id)');
        $this->addSql('ALTER TABLE camping DROP FOREIGN KEY FK_81A904E4A73F0036');
        $this->addSql('DROP INDEX IDX_81A904E4A73F0036 ON camping');
        $this->addSql('ALTER TABLE camping ADD marker_id INT DEFAULT NULL, DROP ville_id');
        $this->addSql('ALTER TABLE camping ADD CONSTRAINT FK_81A904E4474460EB FOREIGN KEY (marker_id) REFERENCES marker (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81A904E4474460EB ON camping (marker_id)');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED9A73F0036');
        $this->addSql('DROP INDEX IDX_3535ED9A73F0036 ON hotel');
        $this->addSql('ALTER TABLE hotel ADD marker_id INT DEFAULT NULL, DROP ville_id');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED9474460EB FOREIGN KEY (marker_id) REFERENCES marker (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3535ED9474460EB ON hotel (marker_id)');
        $this->addSql('ALTER TABLE marker DROP FOREIGN KEY FK_82CF20FEA73F0036');
        $this->addSql('DROP INDEX IDX_82CF20FEA73F0036 ON marker');
        $this->addSql('ALTER TABLE marker DROP ville_id');
        $this->addSql('ALTER TABLE resto DROP FOREIGN KEY FK_892155B1A73F0036');
        $this->addSql('DROP INDEX IDX_892155B1A73F0036 ON resto');
        $this->addSql('ALTER TABLE resto ADD marker_id INT DEFAULT NULL, DROP ville_id');
        $this->addSql('ALTER TABLE resto ADD CONSTRAINT FK_892155B1474460EB FOREIGN KEY (marker_id) REFERENCES marker (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_892155B1474460EB ON resto (marker_id)');
        $this->addSql('DROP INDEX IDX_43C3D9C398260155 ON ville');
        $this->addSql('ALTER TABLE ville DROP region_id');
    }
}
