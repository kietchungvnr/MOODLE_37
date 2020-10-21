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
 * repository_generallibrary class is used to browse general library files
 *
 * @package   repository_generallibrary
 * @copyright 2020 Le Thanh Vu
 * @author    Le Thanh Vu 
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->dirroot . '/repository/lib.php');


class repository_generallibrary extends repository {

    /**
     * user plugin doesn't require login
     *
     * @return mixed
     */
    public function print_login() {
        return $this->get_listing();
    }

    /**
     * Get file listing
     *
     * @param string $encodedpath
     * @return mixed
     */
    public function get_listing($encodedpath = '', $page = '') {
        global $CFG, $USER, $OUTPUT;
        $ret = array();
        $ret['dynload'] = true;
        $ret['nosearch'] = true;
        $ret['nologin'] = true;
        $manageurl = new moodle_url('/local/newsvnr/filelibrary_edit.php');
        $ret['manage'] = $manageurl->out();
        $list = array();

        if (!empty($encodedpath)) {
            $params = json_decode(base64_decode($encodedpath), true);
            if (is_array($params)) {
                $filepath = clean_param($params['filepath'], PARAM_PATH);
                $filename = clean_param($params['filename'], PARAM_FILE);
            }
        } else {
            $itemid   = 0;
            $filepath = '/';
            $filename = null;
        }
        $filearea = 'content';
        $component = 'local_newsvnr';
        $itemid  = 0;
        // $context = context_user::instance($USER->id);
        $context = context_system::instance();
        $maxbytes = get_user_max_upload_file_size($context, $CFG->maxbytes);
        $options = array('subdirs' => 1, 'maxbytes' => $maxbytes, 'maxfiles' => -1, 'accepted_types' => '*');
        $draftitemid = new stdClass();
        file_prepare_standard_filemanager_filelibrary($draftitemid, 'files', $options, $context, 'local_newsvnr', 'content', 0);
        $draftitemid = $draftitemid->files_filemanager;
        try {
            $browser = get_file_browser();

            if ($fileinfo = $browser->get_file_info($context, $component, $filearea, $itemid, $filepath, $filename)) {
                $pathnodes = array();
                $level = $fileinfo;
                $params = $fileinfo->get_params();
                while ($level && $params['component'] == 'user' && $params['filearea'] == 'private') {
                    $encodedpath = base64_encode(json_encode($level->get_params()));
                    $pathnodes[] = array('name'=>$level->get_visible_name(), 'path'=>$encodedpath);
                    $level = $level->get_parent();
                    $params = $level->get_params();
                }
                $ret['path'] = array_reverse($pathnodes);

                // build file tree
                $children = $fileinfo->get_children();
                foreach ($children as $child) {
                    if ($child->is_directory()) {
                        $encodedpath = base64_encode(json_encode($child->get_params()));
                        $node = array(
                            'title' => $child->get_visible_name(),
                            'datemodified' => $child->get_timemodified(),
                            'datecreated' => $child->get_timecreated(),
                            'path' => $encodedpath,
                            'children'=>array(),
                            'thumbnail' => $OUTPUT->image_url(file_folder_icon(90))->out(false)
                        );
                        $list[] = $node;
                    } else {
                        $encodedpath = base64_encode(json_encode($child->get_params()));
                        $node = array(
                            'title' => $child->get_visible_name(),
                            'size' => $child->get_filesize(),
                            'datemodified' => $child->get_timemodified(),
                            'datecreated' => $child->get_timecreated(),
                            'author' => $child->get_author(),
                            'license' => $child->get_license(),
                            'isref' => $child->is_external_file(),
                            'source'=> $encodedpath,
                            'icon' => $OUTPUT->image_url(file_file_icon($child, 24))->out(false),
                            'thumbnail' => $OUTPUT->image_url(file_file_icon($child, 90))->out(false)
                        );
                        if ($child->get_status() == 666) {
                            $node['originalmissing'] = true;
                        }
                        if ($imageinfo = $child->get_imageinfo()) {
                            $fileurl = moodle_url::make_draftfile_url($draftitemid, $child->get_filepath(), $child->get_filename());
                            $node['realthumbnail'] = $fileurl->out(false, array('preview' => 'thumb',
                                'oid' => $child->get_timemodified()));
                            $node['realicon'] = $fileurl->out(false, array('preview' => 'tinyicon', 'oid' => $child->get_timemodified()));
                            $node['image_width'] = $imageinfo['width'];
                            $node['image_height'] = $imageinfo['height'];
                        }
                        $list[] = $node;
                    }
                }
            }
        } catch (Exception $e) {
            throw new repository_exception('emptyfilelist', 'repository_user');
        }
        $ret['list'] = $list;
        $ret['list'] = array_filter($list, array($this, 'filter'));
        return $ret;
    }

    /**
     * Does this repository used to browse moodle files?
     *
     * @return boolean
     */
    public function has_moodle_files() {
        return true;
    }

    /**
     * User cannot use the external link to dropbox
     *
     * @return int
     */
    public function supported_returntypes() {
        return FILE_INTERNAL | FILE_REFERENCE;
    }

    /**
     * Is this repository accessing private data?
     *
     * @return bool
     */
    public function contains_private_data() {
        return false;
    }
}
