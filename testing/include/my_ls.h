#ifndef MY_LS_H
#define MY_LS_H

#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <dirent.h>
#include <ctype.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <time.h>
#include <pwd.h>
#include <grp.h>

typedef struct Informations Informations;
struct Informations
{
    char type;
    char *permissions;
    int links;
    char *user;
    char *group;
    int size;
    char *date;
    char *filename;
    char *path_link;
    int id;
    struct stat stat;
};

typedef struct Entry Entry;
struct Entry
{
    Informations file;
};

void my_putchar(char c);
void my_putstr(const char *str);
char *my_strcat(char *dest, const char src);
char *my_strcpy(char *dest, const char *src);
int my_strlen(const char *str);
void my_putnbr(int n);
char *my_old_strcat(char *dest, const char *src);

void send_error(char *directory);

int count_content(char *to_open);
void show_content(Entry file);
void show_info_content(Entry entry);

int get_nb(int argc, char **argv);
char **get_routes(int argc, char **argv);
void get_args(int argc, char **argv, char *currentDir);
void l_opt_get_args(int argc, char **argv, char *currentDir);
void a_opt_get_args(int argc, char **argv, char *currentDir);
void r_opt_get_args(int argc, char **argv, char *currentDir);
int my_strcmpv2(const char *s1, const char *s2);
void my_swapv2(char **a, char **b);
void find_two_first(char **array, int count);
char *to_path(const char *s1, const char *s2);
void my_swapv3(Informations *a, Informations *b);
void sort_roots(Entry *roots);

void print_perm(struct stat buff);
char *get_date(struct stat buff);
char *get_uname(uid_t uid, char *filename);
char *get_gname(gid_t gid);
char init_type(struct stat buff);
char *init_perm(struct stat buff);
Entry *init_entry(char *root);
int get_link(struct stat buff, Informations file, char *root);
Informations init_file(char *root, int i, char *f_name);
char *init_user(char *root, char *f_name);
char *init_group(char *root, char *f_name);

#endif
