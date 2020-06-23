<?php
/*
 * Copyright (c) 2020  Ron Lucke
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 */

class OverviewController extends StudipController
{
    public function index_action()
    {
        global $perm;

        Navigation::activateItem('/course/klausureinsicht/overview');
        $this->body_id = 'Klausureinsicht-overview';
        $this->cid = Context::getId();

        if(!$perm->have_studip_perm('dozent', $this->cid)) {
            throw new AccessDeniedException('Sie verfügen nicht über die notwendigen Rechte für diese Aktion.');
        }

        $stored_folder = ExamReviewFolders::findOneBySQL('seminar_id = ?', array($this->cid));

        if($stored_folder == null) {
            $this->hasNoFolder = true;
        } else {
            $this->hasNoFolder = false;
        }
        $review_visits = ExamReviewVisits::findBySQL('seminar_id = ?', array($this->cid));

        $this->visits = array();

        $datafield = DataField::findOneBySQL('name = ?', array('Matrikelnummer'));

        foreach ($review_visits as $visit) {
            $user = User::find($visit->user_id);
            $datafield_entries = DataFieldEntry::getDataFieldEntries($user->id);
            $matrikelnummer = $datafield_entries[$datafield->id]->getDisplayValue();
            $visit = array('user' => $user, 'date' => $visit->mkdate, 'matrikelnummer' => $matrikelnummer);
            array_push($this->visits, $visit);
        }
    }
}
