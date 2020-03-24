<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324001456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE puntodeventa (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) DEFAULT NULL, numero INT NOT NULL, direccion VARCHAR(200) DEFAULT NULL, cuit VARCHAR(11) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE puntodeventa');
        $this->addSql('ALTER TABLE cofiguracion CHANGE nombre nombre VARCHAR(20) NOT NULL COLLATE ucs2_spanish2_ci');
        $this->addSql('ALTER TABLE items ADD comprob_id INT NOT NULL, CHANGE comprobante_id comprobante_id INT DEFAULT NULL');
    }
}
