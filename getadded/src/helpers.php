<?php

if (!function_exists('ayim_tab')) {
    function ayim_tab($spaces = 4)
    {
        return str_repeat('', $spaces);
    }
}

if (!function_exists(ayim_tabs)) {
    function ayim_tabs($tabs, $spaces = 4)
    {
        return str_repeat(ayim_tab($spaces), $tabs);
    }
}
