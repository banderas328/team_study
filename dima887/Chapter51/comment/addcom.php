<?php


// Устанавливаем соединение с базой данных
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=test',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}
try {
    // 1. Проверяем переданы ли POST-параметры,
    // если ответ положительный, помещаем новое
    // сообщение в базу данных
    if(!empty($_POST))
    {
        $error = [];
        if(empty($_POST['nickname'])) {
            $error[] = "Отсутствует автор";
        }
        if(empty($_POST['content'])) {
            $error[] = "Отсутствует сообщение";
        }
        // Если нет ошибок, помещаем сообщение
        // в базу данных
        if(empty($error))
        {
            $query = "INSERT INTO
                    comments
                  VALUES (
                    NULL,
                    :nickname,
                    :content,
                    NOW(),
                    1)";
            $usr = $pdo->prepare($query);
            $usr->execute([
                'nickname' => $_POST['nickname'],
                'content' => $_POST['content'],
            ]);
        }
    }
    // 2. Выводим сообщения в порядке убывания
    // даты из размещения
    $query = "SELECT * 
              FROM comments
              WHERE is_visible = 1
              ORDER BY created_at DESC";
    $com = $pdo->query($query);
    while($comments = $com->fetch()) {
        // Обрабатываем сообщения перед выводом,
        // чтобы исключить вставку JavaScript-кода
        $comments['nickname'] = htmlspecialchars($comments['nickname']);
        $comments['content'] = nl2br(htmlspecialchars($comments['content']));
        // Выводим сообщение
        echo "<div>".
            "<span class='author'>{$comments['nickname']}</span> ".
            "<span class='date'>{$comments['created_at']}</span> ".
            "<span class='content'>{$comments['content']}</span>".
            "</div>";
    }
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}