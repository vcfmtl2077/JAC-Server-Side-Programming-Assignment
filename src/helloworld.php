<?php
function decimalToHexSafe($dec) {
    // Check for zero case first to avoid infinite loop
    if ($dec == 0) {
        return '0';
    }

    $hexString = '';
    $hexMap = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];

    while ($dec > 0) {
        $remainder = $dec % 16;
        $hexString = $hexMap[$remainder] . $hexString;
        $decimalNumber = (int)($dec / 16);
    }

    return $hexString;
}

// Example usage:
$decimalNumber = 225; // Example decimal number
echo decimalToHexSafe($decimalNumber); // Outputs "FF"
