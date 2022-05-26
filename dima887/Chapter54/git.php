<?php


/**
 * ************  Система контроля версий Git   **************
*/


/**
 * Постустановочная настройка
 * git config --global user.name=dima887
 * git config --global user.email=mail@mail.ru
 *
*/


/**
 * Инициализация репозитория
 *
 * Пустой Git-репозиторий
 * git init
 *
 * Добавить все файлы в проект
 * git add .
 *
 * Зафиксировать
 * git commit -am 'Инициализация git-репозитория'
 *
 * Регистрирует проект
 * git remote add original git@github.com:dima887/hello.git
 *
 * Отправить содержимое ветки в удаленный репозиторий
 * git push -u original master
 *
 * Получить обновления
 * git pull
*/


/**
 * Клонирование репозитория
 *
 * git clone https://github.com/phpmyadmin/phpmyadmin.git
 *
 * git-репозиторий в папку
 * git clone https://github.com/phpmyadmin/phpmyadmin.git mysql.dev
*/

/**
 * Посмотреть изменения в файлах
 * git diff --cached
 *
 * История изменений
 * git log -n 3
*/

/**
 * https://www.toptal.com/developers/gitignore
 * .gitignore
 *
 * исключить все файлы в папке log
 * log/*
*/

/**
 * Метки
 *
 * Просмотр всех меток
 * git tag
 *
 * Отфильтровать
 * git tag -l 'release_3_0_*'
 *
 * Создать метку
 * git tag -a v1.3.10 -m 'Стабильное состояние проекта'
 *
 * Информация о коммите с меткой
 * git show v1.3.10
*/

/**
 * Ветки
 *
 * Список веток и звездочкой помечается текущая ветка
 * git branch
 *
 * Создать новую ветку
 * git branch blog
 *
 * Переключится на другую ветку
 * git checkout blog
 *
 * Создание и переключение одной командой
 * git checkout -d blog
 *
 * Переименовать ветку
 * git branch -m old_name new_name
 *
 * Удалить ветку
 * git branch -D blog
 *
 *
 * Объединение веток
 * git merge blog
 *
 * Процесс создания и слияния веток при помощи псевдографики
 * git log --graph
*/

/**
 *
 */