<?php

function check_encode(string $str)
{
  if ( ctype_alpha($str) ) {  // si la chaine est uniquement constituée de lettres, on lance la fonction encode_rle
    return encode_rle($str);
  } else {
    return "$$$";             // sinon on renvoie $$$
  }
}

function encode_rle(string $str)
{
  $size = strlen($str);       // on récupère la taille de notre string
  $i = 1;
  $let = 1;                   // nombe d'occurence du caractère
  $cur = $str[0];             // caractère à analyser
  $to_ret = NULL;             // string à retourner

  while ($i < $size)
  {
    if ($str[$i] == $cur) {   // si le caractère actuel est le meme que celui recherché
      $let++;
    } else {                  // sinon s'il est différent, on incrit $let et $cur dans $to_ret
      $to_ret .= $let.$cur;
      $let = 1;               // puis on le remet à 1 et on récupère la lettre actuelle
      $cur = $str[$i];
    }
    $i++;
  }

  $to_ret .= $let.$cur;     // on le fait une dernière fois pour récupérer le dernier caractère

  return $to_ret;             // on renvoie notre chaine compressée
}

?>
