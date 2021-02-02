<?php

include 'src/print.php';
include 'src/encoder.php';
include 'src/decoder.php';
include 'src/advanced_encode.php';

$succes = 1;

if ($argc == 3) {
  $str = $argv[2];
  if ($str == "") {
    print_string($str);
  } else if (strcmp($argv[1], "encode") == 0) {
    $str = check_encode($str);
    print_string($str);
  } else if (strcmp($argv[1], "decode") == 0) {
    $str = check_decode($str);
    print_string($str);
  } else {
    echo "Invalid argument : $argv[1]\n";
  }
} else if ($argc == 4) {
  $to_open = $argv[2];
  $to_print_on = $argv[3];
  if (strcmp($argv[1], "encode") == 0) {
    
    $succes = encode_advanced_rle($to_open,$to_print_on);
    if ($succes == 0){
    echo "OK\n";
    } else {
      echo "KO\n";
    }

  } else if (strcmp($argv[1], "decode") == 0) {
    
    $succes = decode_advanced_rle($to_open,$to_print_on);
    if ($succes == 0){
    echo "OK\n";
    } else {
      echo "KO\n";
    }
  }

} else {
  echo "Invalid number of arguments.\n";
  echo "Correct synthax is : php rle.php [encode/decode] [string]\n";
}
