void url_decode(char *st)
{
	char *p = st;
	char hex[3];
	int code;
	do {
		if(*st == '%') {
		hex[0] = *(++st);
		hex[1] = *(++st);
		hex[2] = 0;
		sscanf(hex, "&X", &code);
		*p++ = (char)code;
		}
		else if(*st == '+') *p++ = ' ';
		else *p++ = *st;
	} while(*st++ != 0);
}