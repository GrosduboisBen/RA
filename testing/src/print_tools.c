#include "my_ls.h"

void my_putchar(char c) /* Affiche un caractère */
{
    write(1, &c, 1);
}

void my_putstr(const char *str) /* Affiche une chaine caractère */
{
    int i;
    for (i = 0; str[i] != '\0' && str[i] != '\n'; i++) {
     my_putchar(str[i]);
    }
}

char *my_strcat(char *dest, const char src) /* Permet de concaténer deux chaines de caractère */
{
  char * new_dest = malloc((sizeof(dest)) + sizeof(src));
    int i = 0;
    while ( dest[i] != '\0' ) {
          i++;
    }
    dest[i]= src;
    dest[i]='\0';
    new_dest = dest;
    return (new_dest);
}

char *my_strcpy(char *dest, const char *src) /* Permet de copier le contenu d'une chaine de caractère dans une autre */
{
    char *pt = dest;

    while ( (*dest = *src) ) {
          dest++;
          src++;
    }

    return pt;
}

int my_strlen(const char *str) /* Renvoie la longueur de la chaîne de caractère passé en argument */
{
  	int i;

  	i = 0;

  	while(str[i] != '\0')
  	{
  		i += 1;
  	}
  	return (i);
}

void my_putnbr(int n) /* Permet d'afficher un nombre */
{
    long l = (long) n;

    if ( l < 0 ) {
      my_putchar('-');
      l = l * ( - 1 );
    }

    if (l/10) {
      my_putnbr(l/10);
    }

    my_putchar(l%10 + '0');
}

void send_error(char* directory)
{
  my_putstr("Unable to open the directory '");
  my_putstr(directory);
  my_putstr("'. No such file or directory.\n");
}

char *my_old_strcat(char *dest, const char *src) /* Permet de concaténer deux chaines de caractère */
{
 char * new_dest = malloc((my_strlen(dest)) + my_strlen(src) +1 );
    int i = 0;
    int j = 0;
    while ( dest[i] != '\0' ) {
          i++;
    }
    while ( src[j] != '\0' ) {
          dest[( i + j )] = src[j];
          j++;
    }
    i += j;
    dest[i]='\0';
    new_dest = dest;
    return (new_dest);
}