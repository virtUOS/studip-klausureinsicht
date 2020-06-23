<?php
/*
 * Copyright (c) 2020  Ron Lucke
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 */

class IndexController extends StudipController
{
    public function index_action()
    {
        global $perm, $user;

        Navigation::activateItem('/course/klausureinsicht/index');
        $this->body_id = 'Klausureinsicht-index';
        $this->cid = Context::getId();

        $this->pdf_url = false;

        $datafield = DataField::findOneBySQL('name = ?', array('Matrikelnummer'));
        $datafield_entries = DataFieldEntry::getDataFieldEntries($user->id);
        $matrikelnummer = $datafield_entries[$datafield->id]->getDisplayValue();

        $stored_folder = ExamReviewFolders::findOneBySQL('seminar_id = ?', array($this->cid));

        if(!empty($stored_folder)) {
            $folder = Folder::findOneBySQL('id = ?', array($stored_folder->folder_id));
            if($folder->data_content['download_allowed'] == 1) {
                $file_ref = FileRef::findOneBySQL('folder_id = ? AND name = ?', array($stored_folder->folder_id, $matrikelnummer.'.pdf'));
                if($file_ref) {
                    $this->pdf_url = $file_ref->getDownloadURL(); 
                    $visit = ExamReviewVisits::findOneBySQL('seminar_id = ? AND user_id = ?', array($this->cid, $user->id));
                    if(empty($visit)) {
                        $visit = new ExamReviewVisits();
                        $visit->seminar_id = $this->cid;
                        $visit->user_id = $user->id;
                        $visit->store();
                    }
                }
            }
        }
    }
}
