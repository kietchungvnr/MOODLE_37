<?php


class block_vnr_db_list_competency extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_list_competency');
    }

  
    
    function get_content() {

        if($this->content !== NULL) {
            return $this->content;
        }

        $renderable = new \block_vnr_db_list_competency\output\list_competency_page();
        $renderer = $this->page->get_renderer('block_vnr_db_list_competency');
        
        $this->content = new stdClass();
        $this->content->text = $renderer->render($renderable);
        $this->content->footer = '';
        return $this->content;

    }

     public function applicable_formats() {
        return array('all' => true);
    }
}


