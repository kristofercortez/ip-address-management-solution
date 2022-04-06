<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406172200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create IP Address Table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ip_address` (id INT AUTO_INCREMENT NOT NULL, user_create_id INT DEFAULT NULL, user_update_id INT DEFAULT NULL, ip_address VARCHAR(30) NOT NULL, label VARCHAR(180) NOT NULL, date_create DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_update DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_22FFD58C22FFD58C (ip_address), INDEX IDX_22FFD58CEEFE5067 (user_create_id), INDEX IDX_22FFD58CD5766755 (user_update_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `ip_address` ADD CONSTRAINT FK_22FFD58CEEFE5067 FOREIGN KEY (user_create_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `ip_address` ADD CONSTRAINT FK_22FFD58CD5766755 FOREIGN KEY (user_update_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `ip_address`');
    }
}
