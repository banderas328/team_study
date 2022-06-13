<?php

/**
 * Автозагрузка с помощью spl_autoload_register()
 */

spl_autoload_register();
// Использование классов
$page = new PHP7\Page('О нас', 'Содержимое страницы');
$page->tags();


/**
 * Использование анонимной функции
 */

spl_autoload_register(function($classname) {
    require_once(__DIR__ . "/spl_autoload_register.php");
});
// Использование классов
$page = new PHP7\Page('О нас', 'Содержимое страницы');
$page->tags();