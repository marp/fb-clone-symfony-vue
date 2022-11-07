<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003150450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friend_request (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, date_time DATETIME NOT NULL, INDEX IDX_F284D94F624B39D (sender_id), INDEX IDX_F284D94CD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D94F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D94CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friend_requests DROP FOREIGN KEY FK_EC63B01BCD53EDB6');
        $this->addSql('ALTER TABLE friend_requests DROP FOREIGN KEY FK_EC63B01BF624B39D');
        $this->addSql('DROP TABLE friend_requests');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friend_requests (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, date_time DATETIME NOT NULL, INDEX IDX_EC63B01BF624B39D (sender_id), INDEX IDX_EC63B01BCD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE friend_requests ADD CONSTRAINT FK_EC63B01BCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE friend_requests ADD CONSTRAINT FK_EC63B01BF624B39D FOREIGN KEY (sender_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE friend_request DROP FOREIGN KEY FK_F284D94F624B39D');
        $this->addSql('ALTER TABLE friend_request DROP FOREIGN KEY FK_F284D94CD53EDB6');
        $this->addSql('DROP TABLE friend_request');
    }
}
