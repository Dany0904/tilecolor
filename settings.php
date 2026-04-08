<?php

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    global $DB;

    $settings = new admin_settingpage(
        'local_tilecolor',
        get_string('pluginname', 'local_tilecolor')
    );

    $ADMIN->add('localplugins', $settings);

    //  Obtener campos personalizados tipo "menu"
    $fields = $DB->get_records('user_info_field', ['datatype' => 'menu']);

    $options = [];

    if ($fields) {
        foreach ($fields as $field) {
            // label más amigable
            $options[$field->shortname] = $field->name;
        }
    }

    if (empty($options)) {
        $options = ['' => get_string('nofields', 'local_tilecolor')];
    }

    //  Select en lugar de input
    $settings->add(new admin_setting_configselect(
        'local_tilecolor/profilefield',
        get_string('profilefield', 'local_tilecolor'),
        get_string('profilefield_desc', 'local_tilecolor'),
        '',
        $options
    ));

    $settings->add(new admin_setting_heading(
        'local_tilecolor/info',
        '',
        get_string('profilefield_desc_aviso', 'local_tilecolor')
    ));

    $selected = get_config('local_tilecolor', 'profilefield');

    if ($selected) {

        $field = $DB->get_record('user_info_field', ['shortname' => $selected]);

        if ($field && $field->datatype === 'menu') {

            // 🔹 Valores del menú
            $values = explode("\n", $field->param1);

            foreach ($values as $value) {

                $value = trim($value);

                if (empty($value)) {
                    continue;
                }

                // Color picker por valor
                $settings->add(new admin_setting_configcolourpicker(
                    'local_tilecolor/color_' . md5($value),
                    $value,
                    'Color para "' . $value . '"',
                    '#1670cc'
                ));
            }
        }
    }
}