<?php

class OverviewController extends StudipController
{
    public function index_action()
    {
        Navigation::activateItem('/course/klausureinsicht');
        Navigation::activateItem('/course/klausureinsicht/overview');
        $this->body_id = 'Klausureinsicht-overview';

        $user = $GLOBALS['user'];
        $this->cid = Course::findCurrent()->id;

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
            $matrikelnummer = $datafield_entries[$datafield->id]->value;
            $visit = array('user' => $user, 'date' => $visit->mkdate, 'matrikelnummer' => $matrikelnummer);
            array_push($this->visits, $visit);
        }
    }
}
