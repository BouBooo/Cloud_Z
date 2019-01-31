<?php


// secure a string
function str_secure($string) {
    return trim(htmlspecialchars($string));
}

//clean debug
function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
?>