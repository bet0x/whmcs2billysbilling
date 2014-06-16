<?php
function accountIdSplit($data) {
$rawData = explode(" ", $data);

$find = array("(",")");
$replace = array("","");

$data = str_replace($find, $replace, end($rawData));
return $data;
}
?>