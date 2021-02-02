<?php

function test_number($test)
{
  if (ord($test) <= 57 && ord($test) >= 48) {
    return true;
  } else {
    return false;
  }
}

function test_letter($test)
{
  if (ord($test) <= 90 && ord($test) >= 65) {
    return true;
  } else if (ord($test) <= 122 && ord($test) >= 97){
    return true;
  } else {
    return false;
  }
}

function print_string(string $str)
{
  echo $str;
  echo "\n";
}

?>
