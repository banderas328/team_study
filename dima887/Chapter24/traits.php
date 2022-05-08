<?php

/**
 * *********   Трейты   **********
*/


/**
 * Методы трейтов переписывают методы базовых классов
 * Методы текущего класса переписывают методы трейтов
 */

//Порядок перегрузки методов
class Page {
    public function tags() {
        echo "Page::tags<br />";
    }
    public function authors() {
        echo "Page::authors<br />";
    }
}

trait Author {
    public function tags() {
        echo "Author::tags<br />";
    }
    public function authors() {
        echo "Author::authors<br />";
    }
}

class News extends Page
{
    use Author;

    public function authors() {
        echo "News::authors<br />";
    }
}

$news = new News();
$news->authors(); // News::authors
$news->tags();    // Author::tags

echo "<hr>";
/**
 * Разрешение конфликтов
*/

trait TagC
{
    public function tags()
    {
        echo "TagC::tags<br />";
    }
    public function authors()
    {
        echo "TagC::authors<br />";
    }
}

trait AuthorC
{
    public function tags()
    {
        echo "AuthorC::tags<br />";
    }
    public function authors()
    {
        echo "AuthorC::authors<br />";
    }
}

class NewsC
{
    use AuthorC, TagC
    {
        TagC::tags insteadof AuthorC;
        AuthorC::authors insteadof TagC;
        AuthorC::tags as authorTag;
    }
}

$news = new NewsC();
$news->authors(); // AuthorC::authors
$news->tags();    // TagC::tags
$news->authorTag();    // AuthorC::tags