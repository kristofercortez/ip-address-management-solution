<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407185155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create IP address history table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ip_address_history` (id INT AUTO_INCREMENT NOT NULL, ip_address_id INT DEFAULT NULL, user_create_id INT DEFAULT NULL, description VARCHAR(250) NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', date_create DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_F158FAE95F23F921 (ip_address_id), INDEX IDX_F158FAE9EEFE5067 (user_create_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `ip_address_history` ADD CONSTRAINT FK_F158FAE95F23F921 FOREIGN KEY (ip_address_id) REFERENCES `ip_address` (id)');
        $this->addSql('ALTER TABLE `ip_address_history` ADD CONSTRAINT FK_F158FAE9EEFE5067 FOREIGN KEY (user_create_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `ip_address_history`');
    }
}
