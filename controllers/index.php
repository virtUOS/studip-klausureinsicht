<?php

class IndexController extends StudipController
{
    public function index_action()
    {
        Navigation::activateItem('/course/klausureinsicht');
        Navigation::activateItem('/course/klausureinsicht/index');
        $this->body_id = 'Klausureinsicht-index';

        $user = $GLOBALS['user'];
        $this->cid = Course::findCurrent()->id;

        $datafield = DataField::findOneBySQL('name = ?', array('Matrikelnummer'));
        $datafield_entries = DataFieldEntry::getDataFieldEntries($user->id);
        $matrikelnummer = $datafield_entries[$datafield->id]->value;

        $stored_folder = ExamReviewFolders::findOneBySQL('seminar_id = ?', array($this->cid));

        if(!empty($stored_folder)) {
            $file_ref = \FileRef::findOneBySQL('folder_id = ? AND name = ?', array($stored_folder->folder_id, $matrikelnummer.'.pdf'));
            if($file_ref) {
                $this->pdf_url = $file_ref->getDownloadURL(); 
                $visit = ExamReviewVisits::findOneBySQL('seminar_id = ? AND user_id = ?', array($this->cid, $user->id));
                if(empty($visit)) {
                    $visit = new ExamReviewVisits();
                    $visit->seminar_id = $this->cid;
                    $visit->user_id = $user->id;
                    $visit->store();
                }
            } else {
                $this->pdf_url = false;
            }
        }
    }
}
