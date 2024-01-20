<?php
function sanitize($value){
    $sanitizedValue = filter_input(INPUT_POST, $value ,FILTER_SANITIZE_SPECIAL_CHARS);
    return $sanitizedValue;
}
?>