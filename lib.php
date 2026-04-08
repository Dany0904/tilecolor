<?php

defined('MOODLE_INTERNAL') || die();

function local_tilecolor_before_standard_html_head() {
    global $PAGE;

    if (during_initial_install()) {
        return;
    }

    $color = \local_tilecolor\service::get_user_tile_color();

    if (!$color) {
        return;
    }

    // CSS base
    $PAGE->requires->css('/local/tilecolor/styles_tilecolor.css');

    // JS mínimo (se ejecuta MUY temprano)
    $PAGE->requires->js_amd_inline("
        document.documentElement.style.setProperty('--tilecolor-main', '{$color}');
    ");
}