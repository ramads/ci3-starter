<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('enable_profiler')) {
    function enable_profiler()
    {
        $ci =& get_instance();
        $ci->output->enable_profiler(TRUE);
    }
}

if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dd')) {
    function dd($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

function empty_or_null(&$var, $non_zero = FALSE) {
    if (isset($var)) {
        if (is_string($var)) {
            $var = trim($var);
        }
        if ($non_zero) {
            return (is_null($var) OR empty($var) OR ($var == 0));
        }
        return (is_null($var) OR empty($var));
    } return TRUE;
}

function printv(&$var, $default = NULL) {
    echo !empty_or_null($var) ? $var : (is_null($default) ? "" : $default);
}
