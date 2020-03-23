<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200118114101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE orden_caracteristica (id INT AUTO_INCREMENT NOT NULL, orden_id INT NOT NULL, caracteristica_id INT NOT NULL, valor DOUBLE PRECISION NOT NULL, precio DOUBLE PRECISION NOT NULL, INDEX IDX_B0E893AF9750851F (orden_id), INDEX IDX_B0E893AFA7300D78 (caracteristica_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orden_caracteristica ADD CONSTRAINT FK_B0E893AF9750851F FOREIGN KEY (orden_id) REFERENCES orden (id)');
        $this->addSql('ALTER TABLE orden_caracteristica ADD CONSTRAINT FK_B0E893AFA7300D78 FOREIGN KEY (caracteristica_id) REFERENCES caracteristicas (id)');
        $this->addSql('ALTER TABLE cofiguracion CHANGE nombre nombre VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE orden CHANGE fecha fecha DATE NOT NULL, CHANGE prioridad prioridad INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE orden_caracteristica');
        $this->addSql('ALTER TABLE cofiguracion CHANGE nombre nombre VARCHAR(20) NOT NULL COLLATE ucs2_spanish2_ci');
        $this->addSql('ALTER TABLE orden CHANGE fecha fecha DATE DEFAULT NULL, CHANGE prioridad prioridad INT DEFAULT NULL');
    }
}
