<?php

/**
 *  ******  Установка PHP  в Windows  *******

  http://windows.php.net/download - загрузка бинарного файла

  cd C:\php
  php -v - узнать текущую версию PHP

  ***** Доступ к php из любой директории

  Панель управления->Система->Системные переменные->Дополнительно->Переменные среды
   В разделе Системные переменные, переменная PATH, дополнить путь C:\php
*/


/**
 * ******  Установка PHP в Mac OS X  *******

  xcode-select --install - установить XCode

  Менеджер пакетов
  ruby -e "$ (curl -fsSL https://raw.qithubusercontent.com/Homebrew/install/master/install)"

  Дополнительные библиотеки PHP
  brew install freetype jpeg libpng gd zlib

  Доступ к репозиториям с PHP-дистрибутивами
  brew tap homebrew/dupes
  brew tap homebrew/versions
  brew tap homebrew/homebrew-php

  Установка PHP
  brew install php70
  php -v

  ~/.bash _profile:
  PATH=/usr/local/sbin:$PATH

  Автоматический запуск PHP-FPM-сервера

  ln -sfv /usr/local/opt/php70/*.plist ~/Library/LaunchAgents
*/


/**
 *  ******** Установка PHP в Linux (Ubuntu)

  Обновить сведения о репозиториях и текущие пакеты
  sudo apt-get update
  sudo apt-get upgrade

  Установка PHP

  sudo apt-get install php7
  php -v

*/


/**
 * ******  Файл hosts  *******

  UNIX - /etc/hosts
  Windows - C:\Windows\system32\drivers\etc\hosts

  Например:
  127.0.0.1 site.dev
  127.0.0.1 www.site.dev
  127.0.0.1 project.dev

  Локальные IP-адреса
  127.X.X.X

  Доступ из вне
  php -S 0.0.0.0:4000
  Например http://192.168.0.1:4000
*/


/**
 *  ****** php.ini Файл конфигурации PHP   *******

  php.ini-production - конфигураия для рабочего сервера
  php.ini-development - конфигураия для среды разработки

  Сообщить серверу местоположение php.ini
  Windows - php -S 127.0.0.1:4000 -c C:\php\php.ini
  UNIX - php -S 127.0.0.1:4000 -c /etc/php.ini
 */