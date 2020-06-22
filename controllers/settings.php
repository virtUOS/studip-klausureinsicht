<?php

class SettingsController extends StudipController
{
    public function index_action()
    {
        Navigation::activateItem('/course/klausureinsicht');
        Navigation::activateItem('/course/klausureinsicht/settings');
        $this->body_id = 'Klausureinsicht-settings';
        $this->cid = Course::findCurrent()->id;

        $stored_folder = ExamReviewFolders::findOneBySQL('seminar_id = ?', array($this->cid));

        if(!empty($stored_folder)) {
            $this->selected_folder = \Folder::findOneBySQL('range_id = ? AND id = ?', array($this->cid, $stored_folder->folder_id));
            $this->hasWrongFolder = \Folder::findOneBySQL('range_id = ? AND id = ? AND folder_type = ?', array($this->cid, $stored_folder->folder_id, 'HiddenFolder'))== null;
            if( $this->selected_folder->data_content['download_allowed'] != 1) {
                $this->hasWrongFolder = true;
            }
        } else {
            $this->selected_folder = null;
            $this->hasWrongFolder = false;
        }

        $this->seminar_folders = array();
        $hidden_folders = \Folder::findBySQL('range_id = ? AND folder_type = ? ORDER BY name', array($this->cid, 'HiddenFolder'));
        
        foreach ($hidden_folders as $hidden_folder) {
            if ($hidden_folder->data_content['download_allowed'] == 1) {
                array_push($this->seminar_folders, $hidden_folder);
            }
        }
    }

    public function store_folder_action()
    {
        if ((Request::get('folder_id') != '') && (Request::get('cid') != '')) { 
            $folder_id = Request::get('folder_id');
            $cid = Request::get('cid');
        } else {
            return $this->redirect('settings');
        }

        $exam_review_folder = ExamReviewFolders::findOneBySQL('seminar_id = ?', array($cid));

        if (!$exam_review_folder) {
            $exam_review_folder = new ExamReviewFolders();
        }

        $exam_review_folder->seminar_id = $cid;
        $exam_review_folder->folder_id = $folder_id;

        $exam_review_folder->store();

        $this->redirect('settings?cid='.$cid);

    }

}
