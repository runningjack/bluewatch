<?php
// application/libraries/Csvimport.php
class Csvimport {
    function get_array($file) {
        $csv = array_map('str_getcsv', file($file));
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv); // remove column header
        return $csv;
    }
}
