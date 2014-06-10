<?php
function accountIdSplit($data) {

$rawData = explode(" (", $data, 2);

$data = $rawData['0'];

return $data;
}
?>