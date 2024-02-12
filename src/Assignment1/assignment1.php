<?php
function bin2dec($bin)
{
  $num = $bin;
  $dec_value = 0;
  $base = 1;

  $temp = $num;
  while ($temp) {
    $last_digit = $temp % 10;
    $temp = $temp / 10;

    $dec_value += $last_digit
      * $base;
    $base = $base * 2;
  }
  return $dec_value;
}
function dec2bin($dec)
{
  $binNum = '';
  while ($dec > 0) {
    $rem = $dec % 2;
    $binNum = $rem . $binNum;
    $dec = (int) ($dec / 2);
  }
  return $binNum !== '' ? $binNum : '0';
}

function bin2hexa($bin)
{
  $hex = '';

  $padLength = 4 - (strlen($bin) % 4);
  if ($padLength < 4) {
    $bin = str_repeat("0", $padLength) . $bin;
  }


  for ($i = 0; $i < strlen($bin); $i += 4) {
    $fourBits = substr($bin, $i, 4);
    $dec = bindec($fourBits);
    $hexDigit = dechex($dec);
    $hex .= $hexDigit;
  }

  return $hex;
}

function hexa2bin($hex)
{
  $dec = hexa2dec($hex);
  return dec2bin($dec);
}
function hexa2dec($hex)
{
  return hexdec($hex);
}

function dec2hexa($dec)
{
  $hex = '';

  while ($dec > 0) {
    $rem = $dec % 16;
    if ($rem < 10) {
      $hex = $rem . $hex;
    } else {
      $hex = chr($rem + 55) . $hex;
    }
    $dec = (int) ($dec / 16);
  }

  return $hex;
}


$bin = "11111011";
echo "binary value is $bin";
echo "<br>";
echo "bin2dec result is " . bin2dec($bin);
echo "<br>";
echo "bin2hexa result is " . bin2hexa($bin);
echo "<br>";
echo "<br>";

$dec = 245;
echo "decimal value is $dec";
echo "<br>";
echo "dec2bin result is " . dec2bin($dec);
echo "<br>";
echo "dec2hexa result is " . dec2hexa($dec);
echo "<br>";
echo "<br>";

$hexa = "0x92";
echo "hex value is $hexa";
echo "<br>";
echo "hexa2bin result is " . hexa2bin($hexa);
echo "<br>";
echo "hexa2dec result is " . hexa2dec($hexa);
