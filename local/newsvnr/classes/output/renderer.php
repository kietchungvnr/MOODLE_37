<?php 
namespace local_newsvnr\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

/**
 * Renderer class for local hackfest.
 *
 * @package    local_hackfest
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Defer to template.
     *
     * @param index_page $page
     *
     * @return string html for the page
     */

    public function render_news_page(news_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('local_newsvnr/news', $data);
    }

    public function render_newsdetail_page(newsdetail_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('local_newsvnr/newsdetail', $data);
    }  
    public function render_forum_page(forum_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('local_newsvnr/forum', $data);
    }
    public function render_course_page(course_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('local_newsvnr/course', $data);
    }
    public function render_orgmain_page(orgmain_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('local_newsvnr/orgmain', $data);
    }
    public function render_orgcomp_position_page(orgcomp_position_page $page)
    {
        $data = $page->export_for_template($this);
        return parent::render_from_template('local_newsvnr/orgcomp_position', $data);
    }
    public function render_orgmanager_page(orgmanager_page $page)
    {
        $data = $page->export_for_template($this);
        return parent::render_from_template('local_newsvnr/orgmanager', $data);
    }

    public function renderer_api_managerment(api_managerment $page){
         $data = $page->export_for_template($this);

        return parent::render_from_template('local_newsvnr/api_managerment', $data);
    }

}
