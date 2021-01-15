#include "my_ls.h"

int count_content(char *to_open)
{
  DIR* dir = NULL;
  struct dirent *content;
  int count = 0;

  dir = opendir(to_open);                                                                                         /* Ouverture du dossier */
  if (dir == NULL) {                                                                                              /* Vérification que le dossier est bien ouvert */
    send_error(to_open);
  } else {
    while ((content = readdir(dir)) != NULL) {                                                                      /* Lecture du dossier */
      count++;
    }
    closedir(dir);
  }
  return count;
}

void show_info_content(Entry entry)
{
      my_putchar(entry.file.type);
      my_putstr(entry.file.permissions);
      my_putchar('\t');
      my_putnbr(entry.file.links);
      my_putchar('\t');
      my_putstr(entry.file.user);
      my_putchar('\t');
      my_putstr(entry.file.group);
      my_putchar('\t');
      my_putnbr(entry.file.size);
      my_putchar('\t');
      my_putstr(entry.file.date);
      my_putchar('\t');
      
      
}

void show_content(Entry entry)
{
     
      my_putstr(entry.file.filename);
      my_putchar('\n');
      
      
}