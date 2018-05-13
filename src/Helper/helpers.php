<?php

if ( !function_exists('lrtrim') ) {
    /**
     * @param string $string
     * @param string $charlist
     *
     * @return string
     */
    function lrtrim(string $string, string $charlist = " \t\n\r\0\x0B"): string
    {
        return trim(rtrim(ltrim($string, $charlist), $charlist));
    }
}
