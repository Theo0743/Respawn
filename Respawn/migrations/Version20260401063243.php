<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260401063243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE Commentaires DROP FOREIGN KEY fk_comm_post');
        $this->addSql('ALTER TABLE Commentaires DROP FOREIGN KEY fk_comm_profil');
        $this->addSql('ALTER TABLE Vote DROP FOREIGN KEY fk_vote_profil');
        $this->addSql('ALTER TABLE Vote DROP FOREIGN KEY fk_vote_post');
        $this->addSql('ALTER TABLE Post DROP FOREIGN KEY fk_post_profil');
        $this->addSql('ALTER TABLE Post DROP FOREIGN KEY fk_post_respawnen');
        $this->addSql('DROP TABLE Commentaires');
        $this->addSql('DROP TABLE Vote');
        $this->addSql('DROP TABLE Respawner');
        $this->addSql('DROP TABLE Post');
        $this->addSql('ALTER TABLE Profils CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE avatar_url avatar_url VARCHAR(255) DEFAULT NULL, CHANGE id_Profil id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE Profils RENAME INDEX mail TO UNIQ_75831F5E5126AC48');
        $this->addSql('ALTER TABLE Profils RENAME INDEX username TO UNIQ_75831F5EF85E0677');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Commentaires (id_commentaire INT AUTO_INCREMENT NOT NULL, contenu TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, id_Post INT NOT NULL, id_Profil INT NOT NULL, INDEX fk_comm_profil (id_Profil), INDEX fk_comm_post (id_Post), PRIMARY KEY(id_commentaire)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Vote (id_vote INT AUTO_INCREMENT NOT NULL, vote_type TINYINT(1) DEFAULT NULL, id_Profil INT NOT NULL, id_Post INT NOT NULL, INDEX fk_vote_post (id_Post), INDEX fk_vote_profil (id_Profil), PRIMARY KEY(id_vote)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Respawner (id_Respawner INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, bannieres VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(id_Respawner)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Post (id_Post INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, contenu TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\', id_Profil INT NOT NULL, id_Respawnen INT NOT NULL, INDEX fk_post_respawnen (id_Respawnen), INDEX fk_post_profil (id_Profil), PRIMARY KEY(id_Post)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE Commentaires ADD CONSTRAINT fk_comm_post FOREIGN KEY (id_Post) REFERENCES Post (id_Post) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Commentaires ADD CONSTRAINT fk_comm_profil FOREIGN KEY (id_Profil) REFERENCES Profils (id_Profil) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Vote ADD CONSTRAINT fk_vote_profil FOREIGN KEY (id_Profil) REFERENCES Profils (id_Profil) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Vote ADD CONSTRAINT fk_vote_post FOREIGN KEY (id_Post) REFERENCES Post (id_Post) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT fk_post_profil FOREIGN KEY (id_Profil) REFERENCES Profils (id_Profil) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT fk_post_respawnen FOREIGN KEY (id_Respawnen) REFERENCES Respawner (id_Respawner) ON DELETE CASCADE');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE profils CHANGE nom nom VARCHAR(50) DEFAULT \'NULL\', CHANGE prenom prenom VARCHAR(50) DEFAULT \'NULL\', CHANGE mail mail VARCHAR(100) NOT NULL, CHANGE username username VARCHAR(30) NOT NULL, CHANGE avatar_url avatar_url VARCHAR(255) DEFAULT \'NULL\', CHANGE id id_Profil INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_Profil)');
        $this->addSql('ALTER TABLE profils RENAME INDEX uniq_75831f5ef85e0677 TO username');
        $this->addSql('ALTER TABLE profils RENAME INDEX uniq_75831f5e5126ac48 TO mail');
    }
}
