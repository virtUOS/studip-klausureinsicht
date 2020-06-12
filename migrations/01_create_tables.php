<?php

/**
 * Setup table
 *
 * @author <lucke@elan-ev.de>
 */


class CreateTables extends Migration
{

    public function description()
    {
        return 'Setup tables for Klausureinsicht-Plugin.';
    }

    public function up()
    {
        $db = DBManager::get();

        $db->exec("CREATE TABLE IF NOT EXISTS `exam_review_folders` (
          `seminar_id` varchar(32) NOT NULL,
          `folder_id` varchar(32) DEFAULT NULL,
          `chdate` int(11) DEFAULT NULL,
          `mkdate` int(11) DEFAULT NULL,
          PRIMARY KEY (`seminar_id`)
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS `exam_review_visits` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `seminar_id` varchar(32) NOT NULL,
          `user_id` varchar(32) DEFAULT NULL,
          `mkdate` int(11) DEFAULT NULL,
          PRIMARY KEY (`id`)
        )");

        SimpleORMap::expireTableScheme();
    }

    public function down()
    {
        DBManager::get()->exec("DROP TABLE exam_review_folders");
        DBManager::get()->exec("DROP TABLE exam_review_visits");

        SimpleORMap::expireTableScheme();
    }
}
