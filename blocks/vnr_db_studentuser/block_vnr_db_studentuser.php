<?php


class block_vnr_db_studentuser extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_studentuser');
    }

    function get_content() {
        
        if($this->content !== NULL) {
            return $this->content;
        }

        $renderable = new \block_vnr_db_studentuser\output\studentuser_page();
        $renderer = $this->page->get_renderer('block_vnr_db_studentuser');
        
        $this->content = new stdClass();
        $this->content->text = $renderer->render($renderable);
        $this->content->footer = '';
        return $this->content;

    }

     public function applicable_formats() {
        return array('my' => true, 'my-newsvnr-student' => true);
    }
}


