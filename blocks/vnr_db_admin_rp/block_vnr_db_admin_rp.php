<?php


class block_vnr_db_admin_rp extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_admin_rp');
    }

    function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;
       
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        $get_list_courseid_by_teacher = get_list_courseid_by_teacher($USER->id);
        if($get_list_courseid_by_teacher) {
            $renderable = new \block_vnr_db_admin_rp\output\admin_rp_page();
            $renderer = $this->page->get_renderer('block_vnr_db_admin_rp');
            $this->content = new stdClass();
            $this->content->text = $renderer->render($renderable);
            $this->content->footer = '';
            return $this->content;
        } else {
            return $this->content;
        }
    }

     public function applicable_formats() {
        return array('my' => true, 'my-newsvnr' => true);
    }
}


