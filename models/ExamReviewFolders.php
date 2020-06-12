<?php

/**
 * @author  <lucke@elan-ev.de>
 *
 * @property string  $seminar_id
 * @property string  $folder_id
 * @property int     $chdate
 * @property int     $mkdate
 */

class ExamReviewFolders extends SimpleORMap
{
    protected static function configure($config = array())
    {
        $config['db_table'] = 'exam_review_folders';

        parent::configure($config);
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
    }
}