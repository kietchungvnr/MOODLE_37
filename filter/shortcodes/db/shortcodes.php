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
 * Shortcodes definitions.
 *
 * @package    filter_shortcodes
 * @copyright  2018 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$shortcodes = [
    'coursefullname' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:coursefullname'
    ],
    'coursestartdate' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:coursestartdate'
    ],
    'courseenddate' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:courseenddate'
    ],
    'coursetimecreated' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:coursetimecreated'
    ],
    'courseshortname' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:courseshortname'
    ],
    'courselink' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:courselink'
    ],
    'userfullname' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:userfullname'
    ],
    'userorgstructure' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:userorgstructure'
    ],
    'userorgposition' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:userorgposition'
    ],
    'userorgjobtitle' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:userorgjobtitle'
    ],
    'usercode' => [
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:usercode'
    ],
    'off' => [
        'wraps' => true,
        'callback' => 'filter_shortcodes\shortcodes::handle',
        'description' => 'shortcode:off'
    ],
];
