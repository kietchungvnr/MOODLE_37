<?php


class block_vnr_db_viewreport extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_viewreport');
    }

    function get_content() {
       
        if(!has_capability('moodle/tag:editblocks',$this->context) or $this->content !== NULL) {
            return $this->content;
        } else {
            $renderable = new \block_vnr_db_viewreport\output\viewreport_page();
            $renderer = $this->page->get_renderer('block_vnr_db_viewreport');
            $this->content = new stdClass();
            $this->content->text = $renderer->render($renderable);
            $this->content->footer = '';
            return $this->content;
        }
    }

     public function applicable_formats() {
        return array('my' => true);
    }
}


