<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170224124802 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE newsletter_subscriptions (id BIGINT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, postal_code VARCHAR(11) DEFAULT NULL, client_ip VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_B3C13B0BE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medias (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, width INT NOT NULL, height INT NOT NULL, size BIGINT NOT NULL, mime_type VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_12D2AF81B548B0F (path), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposals_themes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, color VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mailjet_emails (id INT UNSIGNED AUTO_INCREMENT NOT NULL, message_batch_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', subject VARCHAR(100) NOT NULL, recipient VARCHAR(255) NOT NULL, template VARCHAR(10) NOT NULL, message_class VARCHAR(255) DEFAULT NULL, request_payload LONGTEXT NOT NULL, request_payload_checksum VARCHAR(40) NOT NULL, response_payload LONGTEXT DEFAULT NULL, response_payload_checksum VARCHAR(40) DEFAULT NULL, delivered TINYINT(1) NOT NULL, sent_at DATETIME NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX mailjet_email_message_batch_uuid (message_batch_uuid), UNIQUE INDEX mailjet_email_uuid (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events_registrations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, event_id INT UNSIGNED DEFAULT NULL, first_name VARCHAR(50) NOT NULL, email_address VARCHAR(100) NOT NULL, postal_code VARCHAR(15) DEFAULT NULL, newsletter_subscriber TINYINT(1) NOT NULL, adherent_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_EEFA30C071F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE committees_memberships (id INT UNSIGNED AUTO_INCREMENT NOT NULL, adherent_id INT UNSIGNED DEFAULT NULL, committee_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', privilege VARCHAR(10) NOT NULL, joined_at DATETIME NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_E7A6490E25F06C53 (adherent_id), INDEX committees_memberships_role_idx (privilege), UNIQUE INDEX adherent_has_joined_committee (adherent_id, committee_uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE committees (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, canonical_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, facebook_page_url VARCHAR(255) DEFAULT NULL, twitter_nickname VARCHAR(255) DEFAULT NULL, google_plus_page_url VARCHAR(255) DEFAULT NULL, status VARCHAR(20) NOT NULL, approved_at DATETIME DEFAULT NULL, refused_at DATETIME DEFAULT NULL, created_by CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', members_counts SMALLINT UNSIGNED NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, address_address VARCHAR(150) DEFAULT NULL, address_postal_code VARCHAR(15) DEFAULT NULL, address_city_insee VARCHAR(15) DEFAULT NULL, address_city_name VARCHAR(255) DEFAULT NULL, address_country VARCHAR(2) NOT NULL, address_latitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', address_longitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', INDEX committee_status_idx (status), UNIQUE INDEX committee_uuid_unique (uuid), UNIQUE INDEX committee_canonical_name_unique (canonical_name), UNIQUE INDEX committee_slug_unique (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles_categories (id INT AUTO_INCREMENT NOT NULL, position SMALLINT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_DE004A0E989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invitations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, message LONGTEXT NOT NULL, client_ip VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adherents (id INT UNSIGNED AUTO_INCREMENT NOT NULL, password VARCHAR(255) DEFAULT NULL, old_password VARCHAR(255) DEFAULT NULL, gender VARCHAR(6) NOT NULL, email_address VARCHAR(255) NOT NULL, phone VARCHAR(35) DEFAULT NULL COMMENT \'(DC2Type:phone_number)\', birthdate DATE DEFAULT NULL, position VARCHAR(20) NOT NULL, status VARCHAR(10) DEFAULT \'DISABLED\' NOT NULL, registered_at DATETIME NOT NULL, activated_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, last_logged_at DATETIME DEFAULT NULL, interests LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', main_emails_subscription TINYINT(1) NOT NULL, referents_emails_subscription TINYINT(1) NOT NULL, local_host_emails_subscription TINYINT(1) NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, managed_area_codes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', managed_area_marker_latitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', managed_area_marker_longitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', address_address VARCHAR(150) DEFAULT NULL, address_postal_code VARCHAR(15) DEFAULT NULL, address_city_insee VARCHAR(15) DEFAULT NULL, address_city_name VARCHAR(255) DEFAULT NULL, address_country VARCHAR(2) NOT NULL, address_latitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', address_longitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', UNIQUE INDEX adherents_uuid_unique (uuid), UNIQUE INDEX adherents_email_address_unique (email_address), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposals (id INT AUTO_INCREMENT NOT NULL, media_id BIGINT DEFAULT NULL, position SMALLINT NOT NULL, published TINYINT(1) NOT NULL, display_media TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, title VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_A5BA3A8F989D9B62 (slug), INDEX IDX_A5BA3A8FEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposal_proposal_theme (proposal_id INT NOT NULL, proposal_theme_id INT NOT NULL, INDEX IDX_6B80CE41F4792058 (proposal_id), INDEX IDX_6B80CE41B85948AF (proposal_theme_id), PRIMARY KEY(proposal_id, proposal_theme_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles (id BIGINT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, media_id BIGINT DEFAULT NULL, published_at DATETIME NOT NULL, published TINYINT(1) NOT NULL, display_media TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, title VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_BFDD3168989D9B62 (slug), INDEX IDX_BFDD316812469DE2 (category_id), INDEX IDX_BFDD3168EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_proposal_theme (article_id BIGINT NOT NULL, proposal_theme_id INT NOT NULL, INDEX IDX_F6B9A2217294869C (article_id), INDEX IDX_F6B9A221B85948AF (proposal_theme_id), PRIMARY KEY(article_id, proposal_theme_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE live_links (id INT AUTO_INCREMENT NOT NULL, position SMALLINT NOT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adherent_activation_keys (id INT UNSIGNED AUTO_INCREMENT NOT NULL, adherent_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', value VARCHAR(40) NOT NULL, created_at DATETIME NOT NULL, expired_at DATETIME NOT NULL, used_at DATETIME DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX adherent_activation_token_unique (value), UNIQUE INDEX adherent_activation_token_account_unique (value, adherent_uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adherent_reset_password_tokens (id INT UNSIGNED AUTO_INCREMENT NOT NULL, adherent_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', value VARCHAR(40) NOT NULL, created_at DATETIME NOT NULL, expired_at DATETIME NOT NULL, used_at DATETIME DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX adherent_reset_password_token_unique (value), UNIQUE INDEX adherent_reset_password_token_account_unique (value, adherent_uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE committee_feed_item (id INT UNSIGNED AUTO_INCREMENT NOT NULL, committee_id INT UNSIGNED DEFAULT NULL, author_id INT UNSIGNED DEFAULT NULL, event_id INT UNSIGNED DEFAULT NULL, item_type VARCHAR(15) NOT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_4F1CDC80ED1A100B (committee_id), INDEX IDX_4F1CDC80F675F31B (author_id), INDEX IDX_4F1CDC8071F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home_blocks (id BIGINT AUTO_INCREMENT NOT NULL, media_id BIGINT DEFAULT NULL, position VARCHAR(20) NOT NULL, position_name VARCHAR(20) NOT NULL, title VARCHAR(70) NOT NULL, subtitle VARCHAR(100) DEFAULT NULL, type VARCHAR(10) NOT NULL, link VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_3EE9FCC5462CE4F5 (position), UNIQUE INDEX UNIQ_3EE9FCC54DBB5058 (position_name), INDEX IDX_3EE9FCC5EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administrators (id INT AUTO_INCREMENT NOT NULL, email_address VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, google_authenticator_secret VARCHAR(255) DEFAULT NULL, role VARCHAR(255) NOT NULL, UNIQUE INDEX administrators_email_address_unique (email_address), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE je_marche_reports (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(30) NOT NULL, email_address VARCHAR(255) NOT NULL, postal_code VARCHAR(11) NOT NULL, convinced LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', almost_convinced LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', not_convinced SMALLINT NOT NULL, reaction LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, amount INT NOT NULL, gender VARCHAR(6) NOT NULL, email_address VARCHAR(255) NOT NULL, phone VARCHAR(35) DEFAULT NULL COMMENT \'(DC2Type:phone_number)\', paybox_result_code VARCHAR(100) DEFAULT NULL, paybox_authorization_code VARCHAR(100) DEFAULT NULL, paybox_payload LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', finished TINYINT(1) NOT NULL, client_ip VARCHAR(50) DEFAULT NULL, donated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, address_address VARCHAR(150) DEFAULT NULL, address_postal_code VARCHAR(15) DEFAULT NULL, address_city_insee VARCHAR(15) DEFAULT NULL, address_city_name VARCHAR(255) DEFAULT NULL, address_country VARCHAR(2) NOT NULL, address_latitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', address_longitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT UNSIGNED AUTO_INCREMENT NOT NULL, organizer_id INT UNSIGNED DEFAULT NULL, committee_id INT UNSIGNED DEFAULT NULL, name VARCHAR(100) NOT NULL, canonical_name VARCHAR(100) NOT NULL, slug VARCHAR(130) NOT NULL, category VARCHAR(5) NOT NULL, description LONGTEXT NOT NULL, capacity INT DEFAULT NULL, begin_at DATETIME NOT NULL, finish_at DATETIME NOT NULL, participants_count SMALLINT UNSIGNED NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, address_address VARCHAR(150) DEFAULT NULL, address_postal_code VARCHAR(15) DEFAULT NULL, address_city_insee VARCHAR(15) DEFAULT NULL, address_city_name VARCHAR(255) DEFAULT NULL, address_country VARCHAR(2) NOT NULL, address_latitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', address_longitude FLOAT (10,6) DEFAULT NULL COMMENT \'(DC2Type:geo_point)\', INDEX IDX_5387574A876C4DDA (organizer_id), INDEX IDX_5387574AED1A100B (committee_id), UNIQUE INDEX event_uuid_unique (uuid), UNIQUE INDEX event_canonical_name_unique (canonical_name), UNIQUE INDEX event_slug_unique (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages (id BIGINT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, title VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_2074E575989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE events_registrations ADD CONSTRAINT FK_EEFA30C071F7E88B FOREIGN KEY (event_id) REFERENCES events (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE committees_memberships ADD CONSTRAINT FK_E7A6490E25F06C53 FOREIGN KEY (adherent_id) REFERENCES adherents (id)');
        $this->addSql('ALTER TABLE proposals ADD CONSTRAINT FK_A5BA3A8FEA9FDD75 FOREIGN KEY (media_id) REFERENCES medias (id)');
        $this->addSql('ALTER TABLE proposal_proposal_theme ADD CONSTRAINT FK_6B80CE41F4792058 FOREIGN KEY (proposal_id) REFERENCES proposals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proposal_proposal_theme ADD CONSTRAINT FK_6B80CE41B85948AF FOREIGN KEY (proposal_theme_id) REFERENCES proposals_themes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316812469DE2 FOREIGN KEY (category_id) REFERENCES articles_categories (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168EA9FDD75 FOREIGN KEY (media_id) REFERENCES medias (id)');
        $this->addSql('ALTER TABLE article_proposal_theme ADD CONSTRAINT FK_F6B9A2217294869C FOREIGN KEY (article_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_proposal_theme ADD CONSTRAINT FK_F6B9A221B85948AF FOREIGN KEY (proposal_theme_id) REFERENCES proposals_themes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE committee_feed_item ADD CONSTRAINT FK_4F1CDC80ED1A100B FOREIGN KEY (committee_id) REFERENCES committees (id)');
        $this->addSql('ALTER TABLE committee_feed_item ADD CONSTRAINT FK_4F1CDC80F675F31B FOREIGN KEY (author_id) REFERENCES adherents (id)');
        $this->addSql('ALTER TABLE committee_feed_item ADD CONSTRAINT FK_4F1CDC8071F7E88B FOREIGN KEY (event_id) REFERENCES events (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE home_blocks ADD CONSTRAINT FK_3EE9FCC5EA9FDD75 FOREIGN KEY (media_id) REFERENCES medias (id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A876C4DDA FOREIGN KEY (organizer_id) REFERENCES adherents (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AED1A100B FOREIGN KEY (committee_id) REFERENCES committees (id)');
    }

    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE proposals DROP FOREIGN KEY FK_A5BA3A8FEA9FDD75');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168EA9FDD75');
        $this->addSql('ALTER TABLE home_blocks DROP FOREIGN KEY FK_3EE9FCC5EA9FDD75');
        $this->addSql('ALTER TABLE proposal_proposal_theme DROP FOREIGN KEY FK_6B80CE41B85948AF');
        $this->addSql('ALTER TABLE article_proposal_theme DROP FOREIGN KEY FK_F6B9A221B85948AF');
        $this->addSql('ALTER TABLE committee_feed_item DROP FOREIGN KEY FK_4F1CDC80ED1A100B');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AED1A100B');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316812469DE2');
        $this->addSql('ALTER TABLE committees_memberships DROP FOREIGN KEY FK_E7A6490E25F06C53');
        $this->addSql('ALTER TABLE committee_feed_item DROP FOREIGN KEY FK_4F1CDC80F675F31B');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574A876C4DDA');
        $this->addSql('ALTER TABLE proposal_proposal_theme DROP FOREIGN KEY FK_6B80CE41F4792058');
        $this->addSql('ALTER TABLE article_proposal_theme DROP FOREIGN KEY FK_F6B9A2217294869C');
        $this->addSql('ALTER TABLE events_registrations DROP FOREIGN KEY FK_EEFA30C071F7E88B');
        $this->addSql('ALTER TABLE committee_feed_item DROP FOREIGN KEY FK_4F1CDC8071F7E88B');
        $this->addSql('DROP TABLE newsletter_subscriptions');
        $this->addSql('DROP TABLE medias');
        $this->addSql('DROP TABLE proposals_themes');
        $this->addSql('DROP TABLE mailjet_emails');
        $this->addSql('DROP TABLE events_registrations');
        $this->addSql('DROP TABLE committees_memberships');
        $this->addSql('DROP TABLE committees');
        $this->addSql('DROP TABLE articles_categories');
        $this->addSql('DROP TABLE invitations');
        $this->addSql('DROP TABLE adherents');
        $this->addSql('DROP TABLE proposals');
        $this->addSql('DROP TABLE proposal_proposal_theme');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE article_proposal_theme');
        $this->addSql('DROP TABLE live_links');
        $this->addSql('DROP TABLE adherent_activation_keys');
        $this->addSql('DROP TABLE adherent_reset_password_tokens');
        $this->addSql('DROP TABLE committee_feed_item');
        $this->addSql('DROP TABLE home_blocks');
        $this->addSql('DROP TABLE administrators');
        $this->addSql('DROP TABLE je_marche_reports');
        $this->addSql('DROP TABLE donations');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE pages');
    }
}
