#include <stdio.h>
#include <stdlib.h>
int main(void)
{
	char *remote_addr = getenv("REMOTE_ADDR");
	char *query_string = getenv("QUERY_STRING");
	printf("Content-type: text/html\n\n");
	printf("<!DOCTYPE html>");
	printf("<html lang='ru'>");
	printf("<head>");
	printf("<title>Работа с переменными окружения</title>");
	printf("<meta charset='utf-8'>");
	printf("</head>");
	printf("<body>");
	printf("<h1>Здравствуйте. Мы  знаем о вас все!</h1>");
	printf("<p>Ваш IP-адрес: %s</p>", remote_addr);
	printf("<p>Вот параметры, которые вы указали: %s</p>", query_string);
	printf("</body>");
	printf("</html>");
}