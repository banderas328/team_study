#include <stdio.h>
#include <stdlib.h>
int main(void)
{
	char *remote_addr = getenv("REMOTE_ADDR");
	char *content_length = getenv("CONTENT_LENGTH");
	char *query_string = getenv("QUERY_STRING");
	int num_bytes = atoi(content_length);
	char *data = (char *)malloc(num_bytes + 1);
	fread(data, 1 num_bytes, stdin);
	data[num_bytes] = 0;
	printf("Content-type: text/html\n\n");
	printf("<!DOCTYPE html>");
	printf("<html lang='ru'>");
	printf("<head>");
	printf("<title>Получение данных POST</title>");
	printf("<meta charset='utf-8'>");
	printf("</head>");
	printf("<body>");
	printf("<h1>Здравствуйте. Мы  знаем о вас все!</h1>");
	printf("<p>Ваш IP-адрес: %s</p>", remote_addr);
	printf("<p>Количество байтов данных: %d</p>", num_bytes);
	printf("<p>Вот параметры, которые вы указали: %s</p>", data);
	printf("<p>А вот то, что мы получили через URL: %s</p>", query_string);
	printf("</body></html>");
}