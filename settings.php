<?php

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    $settings = new admin_settingpage(
        'local_tilecolor',
        get_string('pluginname', 'local_tilecolor')
    );

    $ADMIN->add('localplugins', $settings);

    // Campo perfil shortname
    $settings->add(new admin_setting_configtext(
        'local_tilecolor/profilefield',
        get_string('profilefield', 'local_tilecolor'),
        get_string('profilefield_desc', 'local_tilecolor'),
        '',
        PARAM_TEXT
    ));

    // JSON mapping
    $settings->add(new admin_setting_configtextarea(
        'local_tilecolor/colormapping',
        get_string('colormapping', 'local_tilecolor'),
        get_string('colormapping_desc', 'local_tilecolor'),
        '{}'
    ));
}
