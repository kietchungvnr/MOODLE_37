<?php


class block_vnr_db_viewreport extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_viewreport');
    }

    function user_can_addto($page) {
        // Don't allow people to add the block if they can't even use it
        if (!has_capability('moodle/community:add', $page->context)) {
            return false;
        }

        return parent::user_can_addto($page);
    }

    function user_can_edit() {
        // Don't allow people to edit the block if they can't even use it
        if (!has_capability('moodle/community:add',
                        context::instance_by_id($this->instance->parentcontextid))) {
            return false;
        }
        return parent::user_can_edit();
    }
    function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;
       
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


