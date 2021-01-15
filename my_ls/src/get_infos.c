#include "my_ls.h"

char* get_date(struct stat buff) /* Permet de récupérer la date à partir du buffer */
{
    int i = 3;
    int j = 0;

    char *date = ctime(&buff.st_mtime);
    char *new_date = malloc(sizeof(date));

    while (date[i] != '\n')
    {
        new_date[j] = date[i];
        i++;
        j++;
    }
    new_date[j] = '\0';

    return new_date;
}

void print_perm(struct stat buff) /* Permet d'afficher les permissions d'un fichier/dossier */
{
  my_putstr(buff.st_mode & S_IRUSR ? "r" : "-");
  my_putstr(buff.st_mode & S_IWUSR ? "w" : "-");
  my_putstr(buff.st_mode & S_IXUSR ? "x" : "-");
  my_putstr(buff.st_mode & S_IRGRP ? "r" : "-");
  my_putstr(buff.st_mode & S_IWGRP ? "w" : "-");
  if ((buff.st_mode & S_ISGID) && !(buff.st_mode & S_IXGRP)) {
    my_putstr("S");
  } else if ((buff.st_mode & S_ISGID) && (buff.st_mode & S_IXGRP)) {
    my_putstr("s");
  } else {
    my_putstr((buff.st_mode & S_IXGRP) ? ("x") : ("-"));
  }

  my_putstr(buff.st_mode & S_IROTH ? "r" : "-");
  my_putstr(buff.st_mode & S_IWOTH ? "w" : "-");
  if ((buff.st_mode & S_ISVTX) && !(buff.st_mode & S_IXOTH)) {
    my_putstr("T ");
  } else if ((buff.st_mode & S_ISVTX) && (buff.st_mode & S_IXOTH)) {
    my_putstr("t ");
  } else {
    my_putstr((buff.st_mode & S_IXOTH) ? ("x ") : ("- "));
  }
}
