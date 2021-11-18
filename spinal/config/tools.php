<?php

if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     */
    function dd()
    {
        echo '<pre>';
        array_map(function ($x) { print_r($x); }, func_get_args());
        echo '</pre>';
        die(1);
    }
}