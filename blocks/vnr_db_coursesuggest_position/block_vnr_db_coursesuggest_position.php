<?php


class block_vnr_db_coursesuggest_position extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_coursesuggest_position');
    }

  
    
    function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;

        if($this->content !== NULL) {
            return $this->content;
        }

        $renderable = new \block_vnr_db_coursesuggest_position\output\coursesuggest_position_page();
        $renderer = $this->page->get_renderer('block_vnr_db_coursesuggest_position');
        
        $this->content = new stdClass();
        $this->content->text = $renderer->render($renderable);
        $this->content->footer = '';
        return $this->content;

    }

     public function applicable_formats() {
        return array('my' => true);
    }
}


