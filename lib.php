<?php
defined('MOODLE_INTERNAL') || die();

function local_tilecolor_before_http_headers() {

    if (defined('AJAX_SCRIPT') && AJAX_SCRIPT) {
        return;
    }
    
    global $USER;

    if (!isloggedin() || isguestuser()) {
        return;
    }

    $color = \local_tilecolor\manager::get_user_tile_color($USER->id);
    if (!$color) {
        return;
    }

    $customcss = "
    .tiles .tile {
        border-top-color: {$color} !important;
    }
    .format-tiles .course-content ul.tiles .tile.phototile.tilestyle-1 .photo-tile-text h3, .format-tiles .course-content ul.tiles .tile.phototile.tilestyle-2 .photo-tile-text h3{
		background-color: {$color} !important;
	}
    ";

    // Inyecta CSS dinÃ¡mico
    echo "<style>{$customcss}</style>";
}

