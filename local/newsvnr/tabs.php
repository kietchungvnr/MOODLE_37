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
 
    $row = array();
    $row[] = new tabobject('orgstructure',
                           new moodle_url('/local/newsvnr/orgstructure.php'),
                           get_string('orgstructurecreate', 'local_newsvnr'));
    $row[] = new tabobject('orgcate',
                           new moodle_url('/local/newsvnr/orgcate.php'),
                           get_string('orgcatecreate', 'local_newsvnr'));
    $row[] = new tabobject('orgjobtitle',
                           new moodle_url('/local/newsvnr/orgjobtitle.php'),
                           get_string('orgjobtitlecreate', 'local_newsvnr'));
    $row[] = new tabobject('orgposition',
                           new moodle_url('/local/newsvnr/orgposition.php'),
                           get_string('orgpositioncreate', 'local_newsvnr'));
    echo '<div class="groupdisplay">';
    echo $OUTPUT->tabtree($row, $currenttab);
    echo '</div>';
