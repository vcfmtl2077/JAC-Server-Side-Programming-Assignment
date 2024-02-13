<?php
$filename = "userdata.txt";


$fileContent = file_get_contents($filename);

$pairs = explode(';', $fileContent);


foreach ($pairs as $pair) {
    list($key, $value) = explode('=', $pair, 2) + [null, null]; 
    if (!empty($key) && !empty($value)) {
        echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br>\n";
    }
}

?>