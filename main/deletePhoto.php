<?php
/**
 * Удаление редактируемого фото
 */
session_start();
$strFilePath = filter_input(INPUT_POST,'filePath',FILTER_SANITIZE_STRING);
$strDeletePath = str_replace('/avgPrice/main/','',$strFilePath);
unlink($strDeletePath);

// Обновляем сессию, если в ней участвует файл
if (count($_SESSION['t']['avgPrice']['detailsForm'])){
    foreach ($_SESSION['t']['avgPrice']['detailsForm'] as $k => $arrRow){
        if ($arrRow['photo'] == $strFilePath){
            $_SESSION['t']['avgPrice']['detailsForm'][$k]['photo'] = '';
        }
    }
}