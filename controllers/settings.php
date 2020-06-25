<?php
/*
 * Copyright (c) 2020  Ron Lucke
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 */

class SettingsController extends StudipController
{
    public function index_action()
    {
        global $perm;

        Navigation::activateItem('/course/klausureinsicht/settings');
        $this->body_id = 'Klausureinsicht-settings';
        $this->cid = Context::getId();

        if(!$perm->have_studip_perm('tutor', $this->cid)) {
            throw new AccessDeniedException('Sie verfügen nicht über die notwendigen Rechte für diese Aktion.');
        }

        $stored_folder = ExamReviewFolders::findOneBySQL('seminar_id = ?', array($this->cid));

        if(!empty($stored_folder)) {
            $this->selected_folder = Folder::findOneBySQL('range_id = ? AND id = ?', array($this->cid, $stored_folder->folder_id));
            $this->hasWrongFolder = Folder::findOneBySQL('range_id = ? AND id = ? AND folder_type = ?', array($this->cid, $stored_folder->folder_id, 'HiddenFolder'))== null;
            if( $this->selected_folder->data_content['download_allowed'] != 1) {
                $this->hasWrongFolder = true;
            }
        } else {
            $this->selected_folder = null;
            $this->hasWrongFolder = false;
        }

        $this->seminar_folders = array();
        $hidden_folders = Folder::findBySQL('range_id = ? AND folder_type = ? ORDER BY name', array($this->cid, 'HiddenFolder'));

        foreach ($hidden_folders as $hidden_folder) {
            if ($hidden_folder->data_content['download_allowed'] == 1) {
                array_push($this->seminar_folders, $hidden_folder);
            }
        }
    }

    public function store_folder_action()
    {
        global $perm;

        $this->cid = Context::getId();

        if(!$perm->have_studip_perm('tutor', $this->cid)) {
            throw new AccessDeniedException('Sie verfügen nicht über die notwendigen Rechte für diese Aktion.');
        }

        if ((Request::get('folder_id') != '')) { 
            $folder_id = Request::option('folder_id');
        } else {
            return $this->redirect('settings');
        }

        $exam_review_folder = ExamReviewFolders::findOneBySQL('seminar_id = ?', array($this->cid));

        if (!$exam_review_folder) {
            $exam_review_folder = new ExamReviewFolders();
        }

        $exam_review_folder->seminar_id = $this->cid;
        $exam_review_folder->folder_id = $folder_id;

        $exam_review_folder->store();

        $this->redirect('settings');

    }

}
