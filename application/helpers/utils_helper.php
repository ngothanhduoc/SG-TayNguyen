<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists('is_required')) {

    function is_required($haystack, $needle) {
        $haystack_keys = array_keys($haystack);
        foreach ($needle as $item) {
            if (!in_array($item, $haystack_keys)) {
                return FALSE;
            } else {
                if (empty($haystack[$item]) === TRUE && $haystack[$item] != '0')
                    return FALSE;
            }
        }
        return TRUE;
    }

}
if (!function_exists('make_array')) {

    function make_array($haystack, $needle = array(), $keep_null = FALSE, $check_key_in_haystack = FALSE) {
        $array = array();
        for ($i = 0, $c = count($needle); $i < $c; $i++) {
            $tmp = $haystack[$needle[$i]];
            if ($keep_null === TRUE) {
                if ($check_key_in_haystack === TRUE) {
                    if (array_key_exists($needle[$i], $haystack) === TRUE) {
                        $array[$needle[$i]] = $tmp;
                    }
                } else {
                    $array[$needle[$i]] = $tmp;
                }
            } else {
                if ($tmp != '') {
                    $array[$needle[$i]] = $tmp;
                }
            }
        }
        return $array;
    }

}
if (!function_exists('is_json')) {

    function is_json($stringJson, $null_is_true = FALSE) {
        if (empty($stringJson) === TRUE && $null_is_true === TRUE) {
            return TRUE;
        } elseif (empty($stringJson) === TRUE) {
            return false;
        }
        $json = json_decode($stringJson, TRUE);
        if (is_array($json)) {
            return TRUE;
        } else {
            return FALSE;
        }
        return FALSE;
    }

}
if (!function_exists('mysql_datetime')) {

    function mysql_datetime($time = NULL) {
        if (empty($time) === TRUE)
            $time = time();
        return date('Y-m-d H:i:s', $time);
    }

}
if (!function_exists('mysql_password')) {

    function mysql_password($str) {
        $p = sha1($str, true);
        $p = sha1($p);
        return "*" . strtoupper($p);
    }

}
if (!function_exists('random_string_humanable')) {

    function random_string_humanable($length = 6) {
        for ($i = 0, $pass = '', $vocal = rand(0, 1); $i < $length; $i++, $vocal = !$vocal) {
            $result = $pass.=$vocal ? substr('aeiou', mt_rand(0, 4), 1) : substr('abcdefghijklmnopqrstuvwxyz', mt_rand(0, 25), 1);
        }
        return $result;
    }

}
if (!function_exists('encrypt_url')) {

    function encrypt_url($url) {
        //return $url;
        $parse = parse_url($url);
        return $parse['scheme'] . '://' . $parse['host'] . '/?q=' . urlencode(base64_encode($parse['query']));
    }

}
if (!function_exists('decrypt_url')) {

    function decrypt_url($url) {
        return base64_decode($url);
    }

}
if (!function_exists('parse_level')) {

    function parse_level($parent) {
        return count(explode('>', $parent)) - 1;
    }

}
if (!function_exists('parse_group')) {

    function parse_group($parent) {
        $level = count(explode('>', $parent)) - 1;
        switch ($level) {
            case 1:
                return 1;
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
                return 2;
            case 7:
                return 3;
        }
    }

}
if (!function_exists('dateIsBetween')) {

    function dateIsBetween($from, $to, $date = '') {
        $date = empty($date) ? date('Y-m-d H:i:s') : strtotime($date);
        $from = is_int($from) ? $from : strtotime($from);
        $to = is_int($to) ? $to : strtotime($to);
        return ($date > $from) && ($date < $to);
    }

}
if (!function_exists('genDateControl')) {

    function genDateControl($selected_date = '') {
        if (empty($selected_date))
            $selected_date = date("Y-m-d");
        $time = strtotime($selected_date);
        $day = date('d', $time);
        $month = date('m', $time);
        $year = date('Y', $time);
        $html = '<select name = "day">';
        for ($i = 1; $i < 32; $i++) {
            $selected = '';
            if ($day == $i) {
                $selected = 'selected="selected"';
            }
            $html .= '<option ' . $selected . '>' . $i . '</option>';
        }
        $html .= '</select>';
        $html .= '<select name = "month">';
        for ($i = 1; $i < 13; $i++) {
            $selected = '';
            if ($month == $i) {
                $selected = 'selected';
            }
            $html .= '<option ' . $selected . '>' . $i . '</option>';
        }
        $html .= '</select>';
        $html .= '<select name = "year">';
        for ($i = 1990; $i < 2020; $i++) {
            $selected = '';
            if ($year == $i) {
                $selected = 'selected';
            }
            $html .= '<option ' . $selected . '>' . $i . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

}
if (!function_exists('genTimeControl')) {

    function genTimeControl($selected_time = '') {
        if (empty($selected_time))
            $selected_time = date("H:i");
        $time = strtotime($selected_date);
        $hour = date('H', $time);
        $minute = date('i', $time);
        $html = '<select name = "hour">';
        for ($i = 0; $i < 24; $i++) {
            $selected = '';
            if ($hour == $i) {
                $selected = 'selected="selected"';
            }
            $html .= '<option ' . $selected . '>' . str_pad($i, 2, "0", STR_PAD_LEFT) . '</option>';
        }
        $html .= '</select>';
        $html .= '<select name = "minute">';
        for ($i = 0; $i < 60; $i++) {
            $selected = '';
            if ($minute == $i) {
                $selected = 'selected';
            }
            $html .= '<option ' . $selected . '>' . str_pad($i, 2, "0", STR_PAD_LEFT) . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

}

if (!function_exists('split_content')) {

    function split_content($tag_start, $tag_end, $str) {
        $temp = '';
        $temp1 = '';
        $result = '';
        $temp = explode($tag_start, $str);
        if (count($temp) > 2) {
            for ($i = 1; $i < count($temp); $i++) {
                $temp1 = explode($tag_end, $temp[$i]);
                $result[] = $temp1[0];
            }
        } else {
            $temp1 = explode($tag_end, $temp[1]);
            $result = $temp1[0];
        }
        return $result;
    }

}

function check_security($param) {
    $CI = & get_instance();
    if (empty($param))
        return FALSE;
    $param = $CI->security->xss_clean($param);
    return $param;
}

function get_id_url($param) {
    if (!is_array($param)) {
        $dl_array = explode("-", $param);
        if (is_numeric($dl_array[0]))
            return $dl_array[0];
    }
    return FALSE;
}

function date_sql_format($data, $key_arr) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key][$key_arr] = date("d/m/Y", strtotime($value[$key_arr]));
        }
        return $data;
    }
    return FALSE;
}