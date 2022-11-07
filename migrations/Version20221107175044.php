<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107175044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168A76ED395 ON articles (user_id)');
        $this->addSql('ALTER TABLE comments ADD articles_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A1EBAF6CC ON comments (articles_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168A76ED395');
        $this->addSql('DROP INDEX IDX_BFDD3168A76ED395 ON articles');
        $this->addSql('ALTER TABLE articles DROP user_id');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A1EBAF6CC');
        $this->addSql('DROP INDEX IDX_5F9E962A1EBAF6CC ON comments');
        $this->addSql('ALTER TABLE comments DROP articles_id');
    }
}
