<?php

function check_encode(string $str)
{
  if (ctype_alpha($str)) {  // si la chaine est uniquement constituée de lettres, on lance la fonction encode_rle
    return encode_rle($str);
  } else {
    return "$$$";             // sinon on renvoie $$$
  }
}

function true_encode_rle(string $str)
{
  $size = strlen($str);       // on récupère la taille de notre string
  $i = 1;
  $let = 1;                   // nombe d'occurence du caractère
  $cur = $str[0];             // caractère à analyser
  $to_ret = NULL;             // string à retourner

  while ($i < $size) {
    if ($str[$i] == $cur) {   // si le caractère actuel est le meme que celui recherché
      $let++;
    } else {                  // sinon s'il est différent, on inscrit $let et $cur dans $to_ret
      $to_ret .= $let . $cur;
      $let = 1;               // puis on le remet à 1 et on récupère la lettre actuelle
      $cur = $str[$i];
    }
    $i++;
  }

  $to_ret .= $let . $cur;     // on le fait une dernière fois pour récupérer le dernier caractère

  return $to_ret;             // on renvoie notre chaine compressée
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
    
    while ($str[$j] == $str[$i]) {
      $j++;
      $let++;
      $is_diff = 1;
    }

    if ($let > 1) {
      $temp .= dechex($let) . $str[$i];
    } else {
      $temp .= dechex(0) . dechex(1) . $str[$i];
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
    $to_ret .= dechex(0) . dechex($size) . $new_temp;
  }

  $to_ret = ($to_ret);

  return $to_ret;             // on renvoie notre chaine compressée
}
