<?php namespace Easyshop\Services;

class StringHelperService
{

    /**
     *  Remove symbols and replace spaces with hyphens.
     *
     *  @param string
     *  @return string
     */
    public static function clean($string)
    {
        $string = preg_replace("/\s+/", " ", $string);
        $string = str_replace('-', ' ', trim($string));
        $string = preg_replace("/\s+/", " ", $string);
        $string = str_replace(' ', '-', trim($string));
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

        $string = str_replace(' ', '-', $string);

        return preg_replace('/\s+/','-', $string);
    }

}
