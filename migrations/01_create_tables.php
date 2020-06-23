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
          `seminar_id` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
          `folder_id` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
          `chdate` int(10) unsigned NOT NULL DEFAULT '0',
          `mkdate` int(10) unsigned NOT NULL DEFAULT '0',
          PRIMARY KEY (`seminar_id`)
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS `exam_review_visits` (
          `seminar_id` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
          `user_id` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
          `mkdate` int(10) unsigned NOT NULL DEFAULT '0',
          PRIMARY KEY (`seminar_id`,`user_id`)
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
