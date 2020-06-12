<?php

/**
 * @author  <lucke@elan-ev.de>
 *
 * @property int     $id
 * @property string  $seminar_id
 * @property string  $user_id
 * @property int     $mkdate
 */

class ExamReviewVisits extends SimpleORMap
{
    protected static function configure($config = array())
    {
        $config['db_table'] = 'exam_review_visits';

        parent::configure($config);
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
    }
}