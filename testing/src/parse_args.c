#include "my_ls.h"

int get_nb(int argc, char **argv)
{
  int i = 1;
  int size = 0;

  while (i < argc)
  {
    if (argv[i][0] != 45)
    {
      size++;
    }
    i++;
  }
  return size;
}

char **get_routes(int argc, char **argv)
{
  int i = 1;
  int size = 0;
  int k = 0;
  char **tmp = NULL;
  char **routes = NULL;

  while (i < argc)
  {
    if (argv[i][0] != 45)
    {
      if (routes == NULL)
      {
        routes = malloc(sizeof(char *));
        routes[0] = argv[i];
        size = 1;
      }
      else
      {
        tmp = malloc(size * sizeof(char *));
        for (k = 0; k < size; k++)
        {
          tmp[k] = routes[k];
        }
        free(routes);
        routes = malloc((size + 1) * sizeof(char *));
        for (k = 0; k < size; k++)
        {
          routes[k] = tmp[k];
        }
        free(tmp);
        routes[k] = argv[i];
        size++;
      }
    }
    i++;
  }
  return routes;
}
/* Si pas d'arguments, on lit le répertoire courant, sinon le chemin en argument */
/*void get_args(int argc, char **argv, char *currentDir)
{
  int i =0;
    if (argc == 0) {               
      show_content(currentDir);
    } else {
      if (argc == 1) {
        show_content(argv[0]);
      } else {
        while (i < argc) {
          show_content(argv[i]);
          i++;
          putchar('\n');
        }
      }
    }
} */

char *to_path(const char *root, const char *filename)
{
  char *result = malloc(my_strlen(root) + my_strlen(filename) + 2);

  my_strcpy(result, root);
  my_old_strcat(result, "/");
  my_old_strcat(result, filename);

  return result;
}

void l_opt_get_args(int argc, char **argv, char *currentDir)
{
  Entry **roots = malloc(argc * (sizeof(Entry)));

  int i = 0;
  int j = 0;
  int counter = 0;

  if (argc == 0)
  { /* Si pas d'arguments, on lit le répertoire courant, sinon le chemin en argument */
    roots[0] = init_entry(currentDir);
    sort_roots(roots[0]);
    counter = count_content(currentDir);

    j = 0;
    while (j < counter)
    {
      show_info_content(roots[0][j]);
      show_content(roots[0][j]);
      j++;
    }
    j = 0;
  }
  else
  {
    if (argc == 1)
    {

      roots[0] = init_entry(argv[0]);
      sort_roots(roots[0]);

      counter = count_content(argv[0]);
      j = 0;
      while (j < counter)
      {
        if (roots[0][j].file.filename[0] == 46)
        {
          j++;
        }
        else
        {
          show_info_content(roots[0][j]);
          show_content(roots[0][j]);
          j++;
        }
      }
      j = 0;
    }
    else
    {
      my_putstr("Use none or one arg ");
      my_putchar('\n');

      opterr = 0;
    }
  }
}

void get_args(int argc, char **argv, char *currentDir)
{
  Entry **roots = malloc(argc * (sizeof(Entry)));

  int i = 0;
  int j = 0;
  int counter = 0;

  if (argc == 0)
  { /* Si pas d'arguments, on lit le répertoire courant, sinon le chemin en argument */
    roots[0] = init_entry(currentDir);
    sort_roots(roots[0]);
    counter = count_content(currentDir);

    j = 0;
    while (j < counter)
    if (roots[0][j].file.filename[0] == 46)
      {
        j++;
      }else
    {
      show_content(roots[0][j]);
      j++;
    }
    j = 0;
  }
  else
  {
    if (argc == 1)
    {

      roots[0] = init_entry(argv[0]);
      sort_roots(roots[0]);

      counter = count_content(argv[0]);
      j = 0;
      while (j < counter)
      {
        if (roots[0][j].file.filename[0] == 46)
        {
          j++;
        }
        else
        {

          show_content(roots[0][j]);
          j++;
        }
      }
      j = 0;
    }
    else
    {
      my_putstr("Use none or one arg ");
      my_putchar('\n');

      opterr = 0;
    }
  }
}

void r_opt_get_args(int argc, char **argv, char *currentDir)
{
  Entry **roots = malloc(argc * (sizeof(Entry)));

  int i = 0;
  int j;
  int counter = 0;

  if (argc == 0)
  { /* Si pas d'arguments, on lit le répertoire courant, sinon le chemin en argument */
    roots[0] = init_entry(currentDir);
    sort_roots(roots[0]);
    counter = count_content(currentDir);

    j = (counter - 1);
    while (j != 0)
    {
      if (roots[0][j].file.filename[0] == 46)
      {
        j--;
      }
      else
      {

        show_content(roots[0][j]);
        j--;
      }
    }
    j = counter;
  }
  else
  {
    if (argc == 1)
    {

      roots[0] = init_entry(argv[0]);
      sort_roots(roots[0]);

      counter = count_content(argv[0]);
      j = (counter - 1);
      while (j != 0)
      {
        if (roots[0][j].file.filename[0] == 46)
        {
          j--;
        }
        else
        {

          show_content(roots[0][j]);
          j--;
        }
      }
      j = counter;
    }
    else
    {
      my_putstr("Use none or one arg ");
      my_putchar('\n');
    }
  }
}

void a_opt_get_args(int argc, char **argv, char *currentDir)
{
  Entry **roots = malloc(argc * (sizeof(Entry)));

  int i = 0;
  int j = 0;
  int counter = 0;

  if (argc == 0)
  { /* Si pas d'arguments, on lit le répertoire courant, sinon le chemin en argument */
    roots[0] = init_entry(currentDir);
    sort_roots(roots[0]);
    counter = count_content(currentDir);
      j = 0;
      while (j < counter)
      {

        show_content(roots[0][j]);
        j++;
      }
      j = 0;
  }
  else
  {
    if (argc == 1)
    {

      roots[0] = init_entry(argv[0]);
      sort_roots(roots[0]);

      counter = count_content(argv[0]);
      j = 0;
      while (j < counter)
      {

        show_content(roots[0][j]);
        j++;
      }
      j = 0;
    }

    else
    {
      my_putstr("Use none or one arg ");
      my_putchar('\n');

      opterr = 0;
    }
  }
}
/*while (i < argc) {
          roots[i] = init_entry(argv[i]);
          counter = count_content(argv[0]);
          j=0;
        while (j < counter){
          
          show_content(roots[i][j]);
          j++;
        }
          i++;
        }*/