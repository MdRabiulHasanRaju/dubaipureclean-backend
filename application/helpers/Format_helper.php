<?php

function createServiceLink($data){
    $filter = preg_replace('/[^a-zA-Z0-9_ -]/s','',$data);
    $arr = explode(" ",$filter);
    return implode("-",$arr);
}
?>