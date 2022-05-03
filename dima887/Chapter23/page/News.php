<?php

require_once "CachedA.php";

//Новости
class News extends CachedA
{
    // Конструктор класса
    public function __construct($id)
    {
        // Проверяем нет ли такой страницы в кэше
        if ($this->isCached($this->id($id))) {
            // Есть, инициализируем объект содержимым кэша
            parent::__construct($this->title(), $this->content());
        } else {
            // Данные пока не кэшированы, извлекаем
            // содержимое из базы данных
            // $query = "SELECT * FROM news WHERE id = :id LIMIT 1"
            // $sth = $dbh->prepare($query);
            // $sth = $dbh->execute($query, [$id]);
            // $page = $sth->fetch(PDO::FETCH_ASSOC);
            // parent::__construct($page['title'], $page['title']);
            parent::__construct("Новости", "Содержимое страницы Новости");
        }
    }

    // Уникальный ключ для кэша
    public function id($name)
    {
        return "news_{$name}";
    }
}

//Проверка виртуальных методов.
// Создаем статическую страницу
$id = 3;
$page = new News($id);
$page->render();
echo $page->id($id);