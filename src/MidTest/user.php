<?php
$filename = "student.txt";


$fileContent = file_get_contents($filename);

$pairs = explode(';', $fileContent);


foreach ($pairs as $pair) {
    list($key, $value) = explode('=', $pair, 2);
    if (!empty($key) && !empty($value)) {
        echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br>\n";
    }
}

echo '<br>View Student Data File. <a href="student.txt">Student File</a>';
?>