<?php
function log_query($label, $query, $params = []) {
    $f = __DIR__ . '/query_logs.txt';
    $time = date('Y-m-d H:i:s');
    $entry = "[$time] $label | QUERY: " . $query . " | PARAMS: " . json_encode($params) . PHP_EOL;
    file_put_contents($f, $entry, FILE_APPEND | LOCK_EX);
}
?>
