<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321193655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

       
        $this->addSql('ALTER TABLE cofiguracion CHANGE nombre nombre VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE orden ADD entrega DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cofiguracion CHANGE nombre nombre VARCHAR(20) NOT NULL COLLATE ucs2_spanish2_ci');
        $this->addSql('ALTER TABLE items ADD comprob_id INT NOT NULL, CHANGE comprobante_id comprobante_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DA8A193CD FOREIGN KEY (comprob_id) REFERENCES comprobante (id)');
        $this->addSql('CREATE INDEX IDX_E11EE94DA8A193CD ON items (comprob_id)');
        $this->addSql('ALTER TABLE orden DROP entrega');
    }
}
