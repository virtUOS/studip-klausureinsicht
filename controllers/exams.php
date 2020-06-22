<?php

class ExamsController extends StudipController
{
    public function index_action()
    {
        Navigation::activateItem('/course/klausureinsicht');
        Navigation::activateItem('/course/klausureinsicht/exams');
        $this->body_id = 'Klausureinsicht-exams';

        $this->cid = Course::findCurrent()->id;
        $course_members = CourseMember::findBySQL('seminar_id = ? AND status = ?', array($this->cid, 'autor'));
        $this->seminar_users = [];
        $datafield = DataField::findOneBySQL('name = ?', array('Matrikelnummer'));
        $this->stored_folder = ExamReviewFolders::findOneBySQL('seminar_id = ?', array($this->cid));

        $this->hasNoFolder = true;
        $this->hasWrongFolder = true;

        if(!empty($this->stored_folder)) {
            $this->hasNoFolder = false;
            $folder = \Folder::findOneBySQL('id = ? AND folder_type = ?', array($this->stored_folder->folder_id, 'HiddenFolder'));
            if($folder->data_content['download_allowed'] == 1) {
                $this->hasWrongFolder = false;
                foreach ($course_members as $member) {
                    $user = User::find($member->user_id);
                    $datafield_entries = DataFieldEntry::getDataFieldEntries($member->user_id);
                    $matrikelnummer = $datafield_entries[$datafield->id]->value;
                    $file_ref = \FileRef::findOneBySQL('folder_id = ? AND name = ?', array($this->stored_folder->folder_id, $matrikelnummer.'.pdf'));
                    if($file_ref) {
                        $pdf_url = $file_ref->getDownloadURL();
                        $file_found = true;
                    } else {
                        $pdf_url = '';
                        $file_found = false;
                    }
                    array_push($this->seminar_users, array(
                            'user_nachname' => $user->nachname,
                            'user_vorname' => $user->vorname,
                            'matrikelnummer' => $matrikelnummer,
                            'pdf_url' => $pdf_url,
                            'file_found' => $file_found
                        ));
                }

                $nachname = array_column($this->seminar_users, 'user_nachname');
                array_multisort($nachname, SORT_ASC, $this->seminar_users);
            }
        }

    }
}