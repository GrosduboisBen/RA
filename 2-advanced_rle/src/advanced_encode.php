<?php

function encode_advanced_rle(string $input_path, string $output_path)
{

  if (file_exists($input_path) == TRUE && file_exists($output_path) == FALSE) {
    $to_open = fopen($input_path,"r");
    if(filesize($input_path) == 0){
      fopen($output_path, "w+");
      return 0;
    }else {
    $str = fread($to_open, filesize($input_path));
    }
    $str = check_encode($str);
    if($str != "$$$"){
    $to_print = fopen($output_path, "w+");
    fwrite($to_print, $str);
    fclose($to_open);
    fclose($to_print);
    return 0;
    }else {
      return 1;
    }
  } else {

    return 1;
  }
}

function decode_advanced_rle(string $input_path, string $output_path)
{
  $i = 0;

  if (file_exists($input_path) == TRUE && file_exists($output_path) == FALSE) {
    $to_open = fopen($input_path,"r");
    $str = fread($to_open, filesize($input_path));
    $size = strlen($str);
    while($i <= $size){
      echo "hexa :".bin2hex($str[$i])."\n";
      echo "brut :".$str[$i]."\n";
      echo "bin :".ord($str[$i])."\n\n";
      $i++;
    }
    $str = decode_rle($str);
    if($str != "$$$"){
    $to_print = fopen($output_path, "w+");
    fwrite($to_print, $str);
    fclose($to_open);
    fclose($to_print);
    return 0;
    }else {
      return 1;
    }
  } else {

    return 1;
  }
}
