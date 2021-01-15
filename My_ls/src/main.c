#include "my_ls.h"

int main(int argc, char **argv)
{
  char **routes = NULL;
  char *currentDir = getcwd(NULL, 0);
  int nb_routes = get_nb(argc, argv);
  int c = 0;
  int printed = 0;

  if (argc > 1)
  {
    routes = get_routes(argc, argv);
  }
  while ((c = getopt(argc, argv, "lRrdtaAL")) != -1)
  {
    switch (c)
    {

    case 'l':
      l_opt_get_args(nb_routes, routes, currentDir);
      printed =1;
      break;

    case 'R':
      break;
    case 'r':
        r_opt_get_args(nb_routes, routes, currentDir);
        printed =1;
      break;
    case 'd':
      break;
    case 't':
      break;
    case 'a':
      a_opt_get_args(nb_routes, routes, currentDir);
      printed =1;
      break;
    case 'A':

      break;
    case 'L':

      break;
    case '?':
      
      return 1;
    default:
      return 0;
    }
  }
  if(printed == 0){
  get_args(nb_routes, routes, currentDir);
  }
  /*get_args(nb_routes, routes, currentDir);*/

  free(routes);     /* On free les routes */
  free(currentDir); /* On free le cwd */

  return 0;
}
