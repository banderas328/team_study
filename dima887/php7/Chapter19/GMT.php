<?php ## Работа со временем по GMT.

//При добавлении в баху
// Вычисляет timestamp в Гринвиче, который соответствует
// локальному timestamp-формату значению.
function local2gm($localStamp = false) {
    if ($localStamp === false) $localStamp = time();
    // Получаем смещение часовой зоны в секундах.
    $tzOffset = date("Z", $localStamp);
    // Вычитаем разницу - получаем время по GMT.
    return $localStamp - $tzOffset;
}

//При отображении времени из базы
// Вычисляет локальный timestamp в Гринвиче, который
// соответствует timestamp-форматузначению по GMT. Можно указать
// смещение локальной зоны относительно GMT (в часах),
// тогда будет осуществлен перевод в эту зону (а не в текущую локальную).
function gm2local($gmStamp = false, $tzOffset = false) {
    if ($gmStamp === false) return time();
    // Получаем смещение часовой зоны в секундах.
    if ($tzOffset === false)
        $tzOffset = date("Z", $gmStamp);
    else
        $tzOffset *= 60 * 60;
    // Вычитаем разницу - получаем время по GMT.
    return $gmStamp + $tzOffset;
}


echo date('Y-m-d H:i', gm2local());