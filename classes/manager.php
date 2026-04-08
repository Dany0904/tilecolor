<?php

namespace local_tilecolor;

defined('MOODLE_INTERNAL') || die();

class manager {

    public static function get_user_profile_value($userid, $shortname) {
        global $DB;

        $sql = "
            SELECT d.data
            FROM {user_info_data} d
            JOIN {user_info_field} f ON f.id = d.fieldid
            WHERE d.userid = :userid
            AND f.shortname = :shortname
        ";

        return $DB->get_field_sql($sql, [
            'userid' => $userid,
            'shortname' => $shortname
        ]);
    }

    public static function get_user_tile_color($userid) {

        $field = get_config('local_tilecolor', 'profilefield');
        $mapping = json_decode(
            get_config('local_tilecolor', 'colormapping'),
            true
        );

        if (!$field || !$mapping) {
            return null;
        }

        $value = self::get_user_profile_value($userid, $field);

        return $mapping[$value] ?? null;
    }
}
