<?php 
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Moodle's roshnilite theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 * @package    theme_moove
 * @copyright  2019 LTV
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$slide = $PGAE->theme->setting_file_url('slideimage','slideimage');
if(!empty($slide)){
	$slideimage = $PAGE->theme->setting_file_url('slideimage','slideimage');
}
else {
	$slideimage = $CFG->wwwroot."theme/moove/data/sl-1.jpg";
}
?>
<?php if (!empty($html->slidetext)) { ?>
<ul class="top-slider">
<?php if (!empty($html->slidetext)){ ?>
	<li class="content-wrap">
		<img src="<?php echo $slide; ?>" alt="slide">
	</li>
</ul>
<?php } ?>
<?php } ?>


