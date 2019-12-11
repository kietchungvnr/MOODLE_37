<?php


class block_vnr_db_requirecourse extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_requirecourse');
    }
    
    function get_content() {

        if($this->content !== NULL) {
            return $this->content;
        }

        $renderable = new \block_vnr_db_requirecourse\output\requirecourse_page();
        $renderer = $this->page->get_renderer('block_vnr_db_requirecourse');
        
        $this->content = new stdClass();
        $this->content->text = $renderer->render($renderable);
        $this->content->footer = '';
        return $this->content;

    }

     public function applicable_formats() {
        return array('my' => true);
    }
}


