<?php

namespace local_tilecolor;

defined('MOODLE_INTERNAL') || die();

class service {

    public static function get_user_tile_color(): ?string {
        global $USER;

        if (!isloggedin() || isguestuser()) {
            return null;
        }

        $color = manager::get_user_tile_color($USER->id);

        // Validar formato HEX
        if (!$color || !preg_match('/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/', $color)) {
            return null;
        }

        return $color;
    }
}