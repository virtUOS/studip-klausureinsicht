<?PHP
/*
 * Copyright (c) 2020  Ron Lucke
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 */

require_once 'models/ExamReviewFolders.php';
require_once 'models/ExamReviewVisits.php';

class Klausureinsicht extends StudIPPlugin implements StandardPlugin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIconNavigation($course_id, $last_visit, $user_id)
    {
        return null;
    }

    public function getInfoTemplate($course_id)
    {
        return null;
    }

    public function getTabNavigation($course_id)
    {
        $user  = $GLOBALS['user'];

        if(!$GLOBALS['perm']->have_studip_perm('tutor', $course_id, $user->id)) {
            $navigation = new Navigation('Klausureinsicht', PluginEngine::getURL('klausureinsicht/index'));
            $navigation->setImage(Icon::create('file_pdf', 'info_alt'));
            $navigation->setActiveImage(Icon::create('file_pdf', 'info'));
            $navigation->addSubnavigation('index', clone $navigation);
        }

        if($GLOBALS['perm']->have_studip_perm('tutor', $course_id, $user->id)) {
            $navigation = new Navigation('Klausureinsicht', PluginEngine::getURL('klausureinsicht/overview'));
            $overview = new Navigation('Übersicht');
            $overview->setUrl(PluginEngine::getURL('klausureinsicht/overview'));
            $navigation->addSubnavigation('overview', $overview);

            $settings = new Navigation('Einstellungen');
            $settings->setUrl(PluginEngine::getURL('klausureinsicht/settings'));
            $navigation->addSubNavigation('settings', $settings);

            $exams = new Navigation('Klausuren');
            $exams->setUrl(PluginEngine::getURL('klausureinsicht/exams'));
            $navigation->addSubNavigation('exams', $exams);
        }


        return ['klausureinsicht' => $navigation];
    }

    public function perform($unconsumed_path)
    {
        PageLayout::addStylesheet($this->getPluginURL() . '/assets/css/klausureinsicht.css');
        PageLayout::addScript($this->getPluginURL() . '/assets/js/klausureinsicht.js');

        parent::perform($unconsumed_path);
    }
}
