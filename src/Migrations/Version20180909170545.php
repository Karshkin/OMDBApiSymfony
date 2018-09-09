<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180909170545 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE favorito (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorito_users (favorito_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_67BD183C5AAA879 (favorito_id), INDEX IDX_67BD18367B3B43D (users_id), PRIMARY KEY(favorito_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorito_users ADD CONSTRAINT FK_67BD183C5AAA879 FOREIGN KEY (favorito_id) REFERENCES favorito (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorito_users ADD CONSTRAINT FK_67BD18367B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE favorito_users DROP FOREIGN KEY FK_67BD183C5AAA879');
        $this->addSql('DROP TABLE favorito');
        $this->addSql('DROP TABLE favorito_users');
    }
}
