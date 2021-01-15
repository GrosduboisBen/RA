#include "my_ls.h"

int my_strcmpv2(const char *s1, const char *s2)
{
    int comp_s1, comp_s2;
    short success = 0;

    if (*s1 == '.') {  /*Si le premier caractère est un point, on l'ignore */
      s1++;
    }
    if (*s2 == '.') {  /* Idem pour s2 */
      s2++;
    }

    while ( *s1 != '\0' && *s2 != '\0') {

          comp_s1 = abs(*s1);  /* On récupère la valeur absolue de la valeur ascii */
          comp_s2 = abs(*s2);

          if (comp_s1 >= 65 && comp_s1 <= 90) { /* Transformation des majuscules en minuscules */
             comp_s1 += 32;
          }
          if (comp_s2 >= 65 && comp_s2 <= 90) { /* Transformation des majuscules en minuscules */
             comp_s2 += 32;
          }

          if ( comp_s1 == comp_s2 ) { /* Si les deux caractères sont égaux, on passe au caractère d'après */
             s1++;
             s2++;
          } else {
            success = 1;
            break;
          }
    }

    if (success == 0) { /* Si success = 0, alors il n'a pas trouvé de différence entre les deux strigs. On analyse donc la caractère suivant */
      s1++;
      s2++;
      comp_s1 = abs(*s1);
      comp_s2 = abs(*s2);
    }

    if (comp_s1 == '\0' && comp_s2 != '\0') { /* Si le caractère s1 est un caractère de fin de string, on retourne -1 pour ne rien faire */
      return -1;
    } else if (comp_s2 == '\0' && comp_s1 != '\0') { /* Si le caractère s2 est un caractère de fin de string, on retourne 1 pour les swap */
      return 1;
    } else {
      return ( comp_s1 - comp_s2 ); /* Sinon, on calcule et renvoie la différence entre les 2 lettres */
    }

}

void my_swapv2(char **a, char **b) /* Permet d'échanger les adresses des strings rentrés en param. Le swap de contenu provoquait des pertes de données, on a donc décidé d'utiliser cette méthode*/
{
  char *tmp;

  tmp = *a; /* on stock l'adresse de a dans tmp */
  *a = *b;  /* on passe l'adresse de b dans a */
  *b = tmp; /* on injecte l'adresse de a, qui se trouve dans tmp, dans b */
}

void my_swapv3(Informations *a, Informations *b)
{
  Informations tmp;

  tmp = *a; /* on stock l'adresse de a dans tmp */
  *a = *b;  /* on passe l'adresse de b dans a */
  *b = tmp; /* on injecte l'adresse de a, qui se trouve dans tmp, dans b */
}

void find_two_first(char **array, int count) /* Permet d'isoler directement les 2 premiers répertoires (. et ..)*/
{
  int i = 0;

  for (i = 0; i < count; i++) { /* On cherche . */
    if (array[i][0] == '.' && array[i][1] == '\0') {
      my_swapv2(&array[0], &array[i]); /* On swap */
      break;
    }
  }

  for (i = 1; i < count; i++) { /* On cherche .. */
    if (array[i][0] == '.' && array[i][1] == '.' && array[i][2] == '\0') {
      my_swapv2(&array[1], &array[i]); /* On swap */
      break;
    }
  }
}

void find_two_firstv2(Entry *roots) /* Permet d'isoler directement les 2 premiers répertoires (. et ..)*/
{
  int i = 0;

  while (roots[i].file.filename) {
    if (roots[i].file.filename[0] == '.' && roots[i].file.filename[1] == '\0') {
      my_swapv3(&roots[0].file, &roots[i].file);
      break;
    }
    i++;
  }

  i = 1;
  while (roots[i].file.filename) {
    if (roots[i].file.filename[0] == '.' && roots[i].file.filename[1] == '.' && roots[i].file.filename[2] == '\0') {
      my_swapv3(&roots[1].file, &roots[i].file);
      break;
    }
    i++;
  }
}

void sort_roots(Entry *roots) {
  int i = 0;
  int j = 0;

  find_two_firstv2(roots);

  for( i = 2 ; roots[i].file.filename ; i++ ) {
     for( j = i+1 ; roots[j].file.filename ; j++ ) {
       if( my_strcmpv2(roots[i].file.filename, roots[j].file.filename) > 0 ) {
         my_swapv3(&roots[i].file, &roots[j].file);
       }
     }
   }
}