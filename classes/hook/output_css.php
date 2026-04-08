<?php

namespace local_tilecolor\hook;

use local_tilecolor\manager;
use moodle_page;

defined('MOODLE_INTERNAL') || die();

class output_css {
    public static function add_css(moodle_page $page) {
        global $USER;

        if (!isloggedin() || isguestuser()) {
            return;
        }

        $color = manager::get_user_tile_color($USER->id);
        if (!$color) {
            return;
        }

        $customcss = ".tiles .tile { border-top-color: {$color} !important; }";
        $page->requires->css_code($customcss);
    }
}
