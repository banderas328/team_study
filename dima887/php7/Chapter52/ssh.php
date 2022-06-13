<?php



/**
 * **********   Протокол SSH   ************
*/


/**
 * Ubuntu
 *
 * apt-get install opennssh-server
 * apt-get install ssh
 *
 * Настройки *****
 * /etc/ssh/sshd_config
 * sudo vim /etc/ssh/sshd_config
 *
 * Настройка доступа *****
 *
 * по паролю
 * sudo adduser dima  (login для ssh)
 *
 * по ключу
 * ~/.ssh/authorized_keys
 *
 * для разрешения доступа по RSA
 * RSAAuthentication yes
 * PubkeyAuthentication yes
 *
 * cat id_rsa.pub  >> ~/.ssh/authorized_keys
 *
 * Смена порта
 * в /etc/ssh/sshd_config
 * Port 2222
 * Port 6729
 *
 * Запуск SSH-сервера
 * sudo service ssh start
 *
 * sudo service shh restart
 *
 *
 * Изменения в конг. файле
 * sudo service shh reload
 *
 * Остановка сервера
 * sudo service shh stop
 *
 *
 * Обращение к удаленному серверу
 * ssh 192.168.0.1
 * ssh dima@192.168.0.1
 *
 *
 * Генерация ключа
 * ssh-keygen -t rsa
 *
 *
 * Проброс ключа
 * ForwardAgent yes
 * ssh-add
 *
 *
 * Загрузка и скачивание по SSH-протоколу
 * scp /path/to/source path/to/destination
*/


/**
 * Windows
 *
 * FileZilla
 * Cygwin
 * git for windows
 * PuTTY
 */