<?php
function accountIdSplit($data) {

$rawData = explode(" (", $data, 2); 

$data = str_repalce(")", "", $rawData['1']);

return $data;
}
?>