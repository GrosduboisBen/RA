#include "my_ls.h"

Informations init_file(char *root, int i, char *f_name)
{
    Informations init;

    struct stat buf;

    /*stat(f_name, &buf);*/
    lstat(to_path(root, f_name), &buf);

    char *permission = init_perm(buf);
    init.permissions = permission;

    init.size = buf.st_size;

    init.type = init_type(buf);
    if (init.type == 'l')
    {
        init.path_link = init_link(root, f_name, buf);
    }
    else
    {
        init.path_link = "\0";
    }
    init.date = get_date(buf);
    init.user = init_user(root, f_name);
    init.group = init_group(root, f_name);
    init.filename = f_name;
    init.links = buf.st_nlink;
    init.size = buf.st_size;
    init.stat = buf;
    init.id = i;

    return init;
}

Entry *init_entry(char *root)
{
    int count = count_content(root);
    DIR *dir = NULL;
    struct dirent *content;
    struct stat buf;
    int i = 0;
    Informations tmp;

    Entry *files = malloc(count * sizeof(Entry));

    dir = opendir(root); /* Ouverture du dossier */
    if (dir == NULL)
    { /* Vérification que le dossier est bien ouvert */
        send_error(root);
    }
    else
    {
        while ((content = readdir(dir)) != NULL)
        {

            if (i < count)
            {
                tmp = init_file(root, i, content->d_name);
                files[i].file = tmp;
            }
            i++;
        }
    }
    if (dir != NULL)
    {
        closedir(dir);
        return files;
    }
}

char init_type(struct stat buf)
{

    switch (buf.st_mode & S_IFMT)
    {
    case S_IFLNK:
        return ('l');
        break;
    case S_IFDIR:
        return ('d');
        break;
    default:
        return ('-');
        break;
    }
}
char *init_user(char *root, char *f_name)
{

    struct stat buf;
    struct passwd *u_id;

    /*stat(f_name, &buf);*/
    lstat(to_path(root, f_name), &buf);

    u_id = getpwuid(buf.st_uid);
    char *u_name = u_id->pw_name;

    return u_name;
}

char *init_group(char *root, char *f_name)
{

    struct stat buf;
    struct group *g_id;

    /*stat(f_name, &buf);*/
    lstat(to_path(root, f_name), &buf);

    g_id = getgrgid(buf.st_uid);
    char *g_name = g_id->gr_name;

    return g_name;
}
char *init_link(char *root, char *f_name, struct stat buf)
{ /* Permet de récupérer le chemin du lien symbolique d'un fichier */
    int i = 0;

    char *link;
    ssize_t nbytes, bufsize;

    bufsize = buf.st_size + 1;
    link = malloc(bufsize);

    nbytes = readlink(to_path(root, f_name), link, bufsize);

    link[nbytes] = '\0';

    return link;
}

char *init_perm(struct stat buf) /* Permet d'afficher les permissions d'un fichier/dossier */
{
    char *perm = malloc(9 * (sizeof(char)));

    if (buf.st_mode & S_IRUSR)
    {
        perm[0] = 'r';
    }
    else
    {
        perm[0] = '-';
    }
    if (buf.st_mode & S_IWUSR)
    {
        perm[1] = 'w';
    }
    else
    {
        perm[1] = '-';
    }
    if (buf.st_mode & S_IXUSR)
    {
        perm[2] = 'x';
    }
    else
    {
        perm[2] = '-';
    }
    if (buf.st_mode & S_IRGRP)
    {
        perm[3] = 'r';
    }
    else
    {
        perm[3] = '-';
    }
    if (buf.st_mode & S_IWGRP)
    {
        perm[4] = 'w';
    }
    else
    {
        perm[4] = '-';
    }
    if ((buf.st_mode & S_ISGID) && !(buf.st_mode & S_IXGRP))
    {
        perm[5] = 'S';
    }
    else if ((buf.st_mode & S_ISGID) && (buf.st_mode & S_IXGRP))
    {
        perm[5] = 's';
    }
    else
    {
        if ((buf.st_mode & S_IXGRP))
        {
            perm[5] = 'x';
        }
        else
        {
            perm[5] = '-';
        }
    }
    if (buf.st_mode & buf.st_mode & S_IROTH)
    {
        perm[6] = 'r';
    }
    else
    {
        perm[6] = '-';
    }
    if (buf.st_mode & buf.st_mode & S_IWOTH)
    {
        perm[7] = 'w';
    }
    else
    {
        perm[7] = '-';
    }

    if ((buf.st_mode & S_ISVTX) && (buf.st_mode & S_IXOTH))
    {
        perm[8] = 't';
    }
    else if ((buf.st_mode & S_ISVTX) && (buf.st_mode & S_IXOTH))
    {
        perm[8] = 'T';
    }
    else
    {
        if (buf.st_mode & S_IXOTH)
        {
            perm[8] = 'x';
        }
        else
        {
            perm[8] = '-';
        }
    }
    perm[9] = '\0';
    return perm;
}
