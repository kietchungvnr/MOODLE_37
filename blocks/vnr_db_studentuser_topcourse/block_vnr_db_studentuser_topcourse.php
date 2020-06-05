<?php


class block_vnr_db_studentuser_topcourse extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_studentuser_topcourse');
    }

    function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;
       
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        $renderable = new \block_vnr_db_studentuser_topcourse\output\studentuser_topcourse_page();
        $renderer = $this->page->get_renderer('block_vnr_db_studentuser_topcourse');
        $this->content = new stdClass();
        $listcourse = get_list_course_by_student($USER->id);
        if($listcourse) {
            $this->content->text = $renderer->render($renderable);
        } else {
            $this->content->text = '<div class="d-flex w-100 justify-content-center alert alert-info alert-block fade in ">Chưa tham gia khóa học nào</div>';
        }
        $this->content->footer = '';
        return $this->content;
       
    }

     public function applicable_formats() {
        return array('my' => true, 'my-newsvnr' => true);
    }
}


