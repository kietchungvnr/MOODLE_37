<?php


class block_vnr_db_studentuser_learning_rp extends block_base {
     public function init() {
        // $this->title = get_string('pluginname', 'block_vnr_db_studentuser_learning_rp');
        $this->title = '';
    }

    function get_content() {
        
        if($this->content !== NULL) {
            return $this->content;
        }

        $renderable = new \block_vnr_db_studentuser_learning_rp\output\studentuser_learning_rp_page();
        $renderer = $this->page->get_renderer('block_vnr_db_studentuser_learning_rp');
        
        $this->content = new stdClass();
        $this->content->text = $renderer->render($renderable);
        $this->content->footer = '';
        return $this->content;

    }

     public function applicable_formats() {
        return array('my' => true, 'my-newsvnr-student' => true);
    }
}


