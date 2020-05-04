<?php


class block_vnr_course_topgrade extends block_base {
     public function init() {
        // $this->title = get_string('pluginname', 'block_vnr_course_topgrade');
    }

    function get_content() {
        global $CFG; 
        // require $CFG->wwwroot . '/local/newsvnr/lib.php';
        // var_dump();die;
        if($this->content !== NULL) {
            return $this->content;
        }

        $renderable = new \block_vnr_course_topgrade\output\topgrade_page();
        $renderer = $this->page->get_renderer('block_vnr_course_topgrade');
        
        $this->content = new stdClass();
        $this->content->text = $renderer->render($renderable);
        $this->content->footer = '';
        return $this->content;

    }

    public function applicable_formats() {
        return array(
            'course-view'    => true,
            'site'           => false,
            'mod'            => false,
            'my'             => false
        );
    }
}


