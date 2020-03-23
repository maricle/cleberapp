<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323203545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orden ADD origial DATE DEFAULT NULL, ADD impresion DATE DEFAULT NULL, ADD terminado DATE DEFAULT NULL, ADD entregado DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cofiguracion CHANGE nombre nombre VARCHAR(20) NOT NULL COLLATE ucs2_spanish2_ci');
        $this->addSql('ALTER TABLE items ADD comprob_id INT NOT NULL, CHANGE comprobante_id comprobante_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orden DROP origial, DROP impresion, DROP terminado, DROP entregado');
    }
}
