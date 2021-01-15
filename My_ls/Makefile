CC_FLAGS = -W -Wall -Werror -Wextra -ansi

CC = gcc -I ./include -o my_ls

NAME =	libmy.a

SRC =		./src/print_tools.c		\
				./src/parse_args.c	\
				./src/get_files.c		\
				./src/sort.c	\
				./src/get_infos.c	\
				./src/new_get_file.c	\
				./src/main.c

OBJ =	$(SRC:%.c=%.o)

LIB =	$(OBJ)

RAN = 	ranlib

RM =	rm -f

$(NAME) :	$(OBJ)
		$(CC) $(CC_FLAGS) $(OBJ)
		ar r  $(NAME)
		$(RAN) $(NAME)
		mv $(NAME) ./lib

all :		$(NAME)

clean :
		$(RM) $(OBJ)

fclean :	clean
		$(RM) $(NAME)

re: fclean all
