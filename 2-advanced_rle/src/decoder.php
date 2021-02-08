<?php

function check_decode(string $str)
{
  $size = strlen($str);

  if (test_number($str[0]) && test_letter($str[$size - 1])) { // On teste si le premier caractère est bien un chiffre et le dernier bien une lettre
    return check_syntax($str);
  } else {                                                    // Sinon on renvoie $$$
    return "$$$";
  }
}

function check_syntax(string $str)
{
  $size = strlen($str);
  $i = 1;
  $next_number = false;                       // Passe à true quand on trouve une lettre;

  while ($i < $size) {

    if ($next_number) {                       // Si le caractère précédent est une lettre
      if (!test_number($str[$i])) {           // alors on teste si l'actuel est un chiffre
        return "$$$";                         // car 2 lettres ne peuvent pas se suivre
      }
    }
    $next_number = false;

    if (test_letter($str[$i])) {              // Si le car actuel est une lettre le prochain est forcément un chiffre
      $next_number = true;
      $i++;
    } else if (test_number($str[$i])) {
      $i++;
    } else {
      return "$$$";                           // Si le char n'est ni une lettre ni un chiffre c'est un caractère interdit
    }                                         // on renvoie donc $$$
  }

  return decode_rle($str);
}

function true_decode_rle(string $str)
{
  $size = strlen($str);
  $i = 1;
  $j = 0;
  $mult = 0;
  $to_ret = NULL;
  $num = $str[0];

  while ($i < $size) {
    if (test_number($str[$i])) {
      $num .= $str[$i];
      $i++;
    } else {
      $mult = intval($num);

      if ($mult > 10000000) {
        return "$$$";
      }
      
      while ($j < $mult) {
        $to_ret .= $str[$i];
        $j++;
      }
      $j = 0;
      $num = NULL;
      $i++;
    }
  }
  return $to_ret;
}

function decode_rle(string $str)
{
  $size = strlen($str);
  $i = 0;
  $j = 0;
  $is_num =0;
  $temp =NULL;
  $mult = 0;

  while ($i < $size) {

    if(ord($str[$i]) != 0){
    if($is_num ==0){
      $mult= ord($str[$i]);
      $is_num =1;
      } else{
        while($j <= $mult){
          $temp .= $str[$i];
          $j++;
        }
        $j=0;
        $mult=0;
        $is_num=0;
      }
    }
    $i++;
    }
  return $temp;
}

?>
