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

function decode_syntax(string $str)
{
  $i =0;
  $size= strlen($str);
  $has_letter =0;
  while($i <= $size){
    if(test_letter($str[$i])){
      $has_letter =1;
    }
    $i++;
  }
  if ($has_letter ==0){
    print_string("has no letter");
    return "$$$";
  }else{
    return decode_rle($str);
  }
}

function decode_rle(string $str)
{
  $size = strlen($str);
  $i = 0;
  $j = 0;
  $number =0;
  $is_diff_string =0;
  $temp =NULL;
  $mult = 0;
  $set =0;
  $curr =0;

  while ($i < $size) {
    if($set ==1){
      $i++;
      $set=0;
    }
    if(ord($str[$i]) != 0){
    if($number == 0){
      $mult= ord($str[$i]);
      $number =1;
      } else{
        if($is_diff_string == 1){
          
        while($j < $mult ){
          
          if(test_letter($str[$i])){
          $temp .= $str[$i];
          }
          $i++;
          $j++;
        }
        $j=0;
        $mult=0;
        $is_diff_string =0;
      } else{
        $j = 0;
        $i--;
      
        while($j < $mult){
         
          if($set ==0){
            $i++;
            $set =1;
            }
          if(test_letter($str[$i])){
          $temp .= $str[$i];
          }
          $j++;
         
        }
        
        $i--;
        $j=0;
        $mult=0;
        $number=0;
        $is_diff_string =0;
      }
      
      }
    } else{
      $is_diff_string =1;
    }
    $i++;
   
    }
    
  return ($temp);
}

?>
