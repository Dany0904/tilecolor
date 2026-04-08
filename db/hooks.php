<?php

defined('MOODLE_INTERNAL') || die();

return [
    [
        'hook' => \core\hook\output\page::class,
        'callback' => \local_tilecolor\hook\output_css::class . '::add_css',
    ],
];

