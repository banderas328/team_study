#include <stdio.h>
#include <stdlib.h>
#include <string.h>
int main()
{
	char buf[1000];
	char buf_cookie[1000];
	char *cook = getenv("HTTP_COOKIE");
	if(cook != NULL) {
	srtcpy(buf_cookie, cook + 5);
	}
	char *query = getenv("QUERY_STRING");
	if(query != NULL) {
		strcpy(buf, query + 5);
		printf("Set-cookie: cook=%s; "
		"expires=Thursday, 2-Feb17 15:52:00 GMT\n", buf);
		strcpy(buf_cookie, buf);
	}
	printf("Content-type: text/html\n\n");
	printf("<!DOCTYPE html>");
	printf("<html lang='ru'>");
	printf("<head>");
	printf("<title>cookies</title>\n");
	printf("<meta charset='utf-8'>");
	printf("</head>");
	printf("<body>");
	if(strlen(buf_cookie) > 0) {
		printf("<h1>Здравствуйте, %s!</h1>\n",buf_cookie);
	}
	printf("<form action='/cgi-bin/script.cgi' method='GET'>\n");
	printf("<p>your name</p>");
	printf("<input type='text' name='name' value='%s'>\n", buf_cookie);
	printf("<p><input type='submit' value='send'></p>\n");
	printf("</form>\n");
	printf("</body></html>");
}

