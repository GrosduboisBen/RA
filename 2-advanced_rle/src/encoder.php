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
  $i = 0;
  $j = 0;
  $let = 0;
  $k = 0;                     // nombe d'occurence du caractère
  $temp = NULL;
  $new_temp = NULL;
  $diff_len = 1;
  $is_diff = 0;           // caractère à analyser
  $to_ret = NULL;             // string à retourner

  while ($i < $size) {
    $diff_len = 1;
    if ($j == 0 && $i == 1) {
      $j = $i;
    }
    while ($str[$j] == $str[$i]) {   // Tant que le caractère étudié est similaire au prochain
      $j++;
      $let++;
    }
    if ($let > 1) {
      $temp .= chr($let) . $str[$i];
      $is_diff = 1;
    } else {

      if ($i == 1) {
        $k = $i;
      } else {
        $k = $j + 1;
      }

      while ($str[$k] != $str[$j]) {
        echo "k:" . $k . "\n";
        echo "j:" . $k . "\n";
        echo $diff_len . "\n";
        $diff_len++;
        $k++;
        $j++;
      }
      echo "Sortie \n";
      /*if($i == 1){
        $diff_len++;
      }*/
      $temp .= chr(0) . chr($diff_len);
      if ($i == 1) {
        $temp .= $str[0];
      }
      while ($i < $j) {
        $temp .=  $str[$i];
        $i++;
      }
    }
    if ($let != 0 && $j != 0 && $k == 0) {
      if ($j > $size && $i < $size) {
        $i = $j;
        $let = 0;
      } else if ($k != 0) {
        $k = 0;
        $let = 0;
      } else {
        $i = $j;
        $let = 0;
      }
    } else {
      $let = 0;
      if ($k != 0) {
        $k = 0;
        $i++;
      }
    }
    $k = 0;
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
