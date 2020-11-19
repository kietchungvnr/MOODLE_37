<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package local_newsvnr
 * @copyright 2019 VnResource
 * @author   Le Thanh Vu
 **/

define('AJAX_SCRIPT', false);
define("REQUIRED", 0);
define("FREE", 1);
require_once __DIR__ . '/../../../../config.php';
require_login();
$PAGE->set_context(context_system::instance());
$action = required_param('action', PARAM_TEXT);

$data = [];
switch ($action) {
    case 'exam_filter_required':
        $dataexam = $DB->get_records("exam", ['type' => REQUIRED]);
        foreach ($dataexam as $exam) {
            $object         = new stdclass();
            $object->name   = $exam->name;
            $object->examid = $exam->id;
            $data[]         = $object;
        }
        break;
    case 'subject_filter_required':
        $datasubject = $DB->get_records_sql("SELECT ese.id,es.id as subjectid,es.name,e.id as examid ,ese.id as examsubjectexamid FROM {exam_subject} es
                                                JOIN {exam_subject_exam} ese ON ese.subjectid = es.id
                                                JOIN {exam} e ON ese.examid = e.id
                                            WHERE e.type = :examtype", ['examtype' => REQUIRED]);
        foreach ($datasubject as $subject) {
            $object                    = new stdclass();
            $object->name              = $subject->name;
            $object->id                = $subject->subjectid;
            $object->examid            = $subject->examid;
            $object->examsubjectexamid = $subject->examsubjectexamid;
            $data[]                    = $object;
        }
        break;
    case 'exam_filter_free':
        $dataexam = $DB->get_records("exam", ['type' => FREE]);
        foreach ($dataexam as $exam) {
            $object         = new stdclass();
            $object->name   = $exam->name;
            $object->examid = $exam->id;
            $data[]         = $object;
        }
        break;
    case 'subject_filter_free':
        $datasubject = $DB->get_records_sql("SELECT ese.id,es.id as subjectid,es.name,e.id as examid,ese.id as examsubjectexamid FROM {exam_subject} es
                                                JOIN {exam_subject_exam} ese ON ese.subjectid = es.id
                                                JOIN {exam} e ON ese.examid = e.id
                                            WHERE e.type = :examtype", ['examtype' => FREE]);
        foreach ($datasubject as $subject) {
            $object                    = new stdclass();
            $object->name              = $subject->name;
            $object->id                = $subject->subjectid;
            $object->examid            = $subject->examid;
            $object->examsubjectexamid = $subject->examsubjectexamid;
            $data[]                    = $object;
        }
        break;
    default:
        break;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
die();
