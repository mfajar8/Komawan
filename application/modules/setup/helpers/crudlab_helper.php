<?php

function safe($str)
{
    return strip_tags(trim($str));
}

function readJSON($path)
{
    $string = file_get_contents($path);
    $obj = json_decode($string);
    return $obj;
}

function createFile($string, $path)
{
    $old_umask = umask(0);
    $create = fopen($path, "w",0777) or die("KL_ERROR: Ubah permission folder modules ke 777");
    fwrite($create, $string);
    fclose($create);
    umask($old_umask);
    return $path;
}

function label($str)
{
    $label = str_replace('_', ' ', $str);
    $label = ucwords($label);
    return $label;
}

?>
