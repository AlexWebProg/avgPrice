<?php
/**
 * Проверяем форму перед формированием результата
 */
session_start();
$arrError = array();
if (!count($_SESSION['t']['avgPrice']['detailsForm'])){
    $arrError[] = 'В списке деталей не найдено ни одной детали';
}
if (empty($_SESSION['t']['avgPrice']['strTemplate'])){
    $arrError[] = 'Не выбран шаблон для отображения';
}
if (count($arrError)){
    $arrRes = array('result' => 0, 'error' => $arrError);
}else{
    $arrRes = array('result' => 1, 'url' => '/avgPrice/'.$_SESSION['t']['avgPrice']['strTemplate']);
}
echo(json_encode($arrRes));