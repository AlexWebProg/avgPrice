<?php
/**
 * Обновляем список деталей для отображения
 *
 */
/*
Array
(
    [detailsForm] => Array
    (
        [1] => Array
            (
                    [rowNumber] => 1
                    [part_number] => df
                    [name] =>
                    [description] =>
                    [manufacturer] =>
                    [price] =>
                )

            [2] => Array
            (
                    [rowNumber] => 2
                    [part_number] =>
                    [name] =>
                    [description] =>
                    [manufacturer] =>
                    [price] =>
                )

        )

)
*/
session_start();
$_SESSION['t']['avgPrice']['detailsForm'] = array();
if (!empty($_POST['part_number'])){
    foreach ($_POST['part_number'] as $intKey => $strPartNumber){
        $_SESSION['t']['avgPrice']['detailsForm'][] = array(
            'photo' => filter_var($_POST['photo'][$intKey],FILTER_SANITIZE_STRING),
            'part_number' => filter_var($_POST['part_number'][$intKey],FILTER_SANITIZE_STRING),
            'name' => filter_var($_POST['name'][$intKey],FILTER_SANITIZE_STRING),
            'description' => filter_var($_POST['description'][$intKey],FILTER_SANITIZE_STRING),
            'manufacturer' => filter_var($_POST['manufacturer'][$intKey],FILTER_SANITIZE_STRING),
            'price' => filter_var($_POST['price'][$intKey],FILTER_SANITIZE_STRING)
        );
    }
}
