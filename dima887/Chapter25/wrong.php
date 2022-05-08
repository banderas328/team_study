<?php

require_once(__DIR__ . "/PHP7/Seo.php");
require_once(__DIR__ . "/PHP7/Tag.php");
require_once(__DIR__ . "/PHP7/Page.php");
// Использование классов
$page = new PHP7\Page('О нас', 'Содержимое страницы');
$page->tags(); //Tag::tags