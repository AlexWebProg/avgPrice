<?php
/**
 * Выбираем шаблон для отображения списка деталей
 */
session_start();
$_SESSION['t']['avgPrice']['strTemplate'] = filter_input(INPUT_POST,'strTemplate',FILTER_SANITIZE_STRING);