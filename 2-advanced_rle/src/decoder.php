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

function decode_rle(string $str)
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
function encode_rle(string $str)
{
  $size = strlen($str);       // on récupère la taille de notre string
  $i = 1;
  $j = 0;
  $let = 0;                     // nombe d'occurence du caractère
  $temp = NULL;
  $new_temp = NULL;
  $is_diff = 0;           // caractère à analyser
  $to_ret = NULL;             // string à retourner

  while ($i < $size) {
    
    while ($str[$j] == $str[$i] && $j < $size-1) {
      $j++;
      $let++;
      $is_diff = 1;
    }

    if ($let > 0) {
      $temp .= chr($let) . $str[$i];
    } else {
      $temp .= chr(0) . chr(1) . $str[$i];
    }
    if ($let != 0 && $j != 0) {
       
        if ($j > $size) {
          $i = $j;
          $let = 0;
        } else {
          $i = $j;
          $let = 0;
        }
    } else {
      $let = 0;
      $i++;
    }
  }
  if ($is_diff != 0) {
    $to_ret .= $temp;
  } else {
    $i = 0;

    while ($i <= $size) {
      $new_temp .= $str[$i];
      $i++;
    }
    $to_ret .= chr(0) . chr($size) . $new_temp;
  }

  $to_ret = bin2hex($to_ret);

  return $to_ret;             // on renvoie notre chaine compressée
}
?>
