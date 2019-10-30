<?php


class block_vnr_db_teacheruser_dd extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_teacheruser_dd');
    }

    function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;
       
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        $get_list_courseid_by_teacher = get_list_courseid_by_teacher($USER->id);
        if($get_list_courseid_by_teacher) {
            $renderable = new \block_vnr_db_teacheruser_dd\output\teacheruser_dd_page();
            $renderer = $this->page->get_renderer('block_vnr_db_teacheruser_dd');
            $this->content = new stdClass();
            $this->content->text = $renderer->render($renderable);
            $this->content->footer = '';
            return $this->content;
        } else {
            return $this->content;
        }
       
    }

     public function applicable_formats() {
        return array('my' => true);
    }
}


