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

        $review_visits = ExamReviewVisits::findBySQL('seminar_id = ?', array($this->cid));

        $this->visits = array();

        foreach ($review_visits as $visit) {
            $user = User::find($visit->user_id);
            $visit = array('user' => $user, 'date' => $visit->mkdate);
            array_push($this->visits, $visit);
        }
    }
}
