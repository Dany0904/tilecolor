<?php

namespace local_tilecolor;

defined('MOODLE_INTERNAL') || die();

class manager {

    public static function get_user_profile_value(int $userid, string $shortname): ?string {
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
        ]) ?: null;
    }

    public static function get_user_tile_color(int $userid): ?string {

        $field = get_config('local_tilecolor', 'profilefield');
        $mappingjson = get_config('local_tilecolor', 'colormapping');

        if (!$field || !$mappingjson) {
            return null;
        }

        $mapping = json_decode($mappingjson, true);

        if (!is_array($mapping)) {
            return null;
        }

        $value = self::get_user_profile_value($userid, $field);

        if (!$value || !isset($mapping[$value])) {
            return null;
        }

        return $mapping[$value];
    }
}