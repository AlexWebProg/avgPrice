<?php
/**
 * Изменение названия редактируемого фото
 */
session_start();
function translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',    'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return trim(strtr($string, $converter));
}


$strFilePath = str_replace('/avgPrice/main/','',filter_input(INPUT_POST,'filePath',FILTER_SANITIZE_STRING));
$strFileName = translit(filter_input(INPUT_POST,'fileName',FILTER_SANITIZE_STRING));

if (!empty($strFilePath) and !empty($strFileName)){
    $arrPathInfo = pathinfo($strFilePath);
    if (rename($strFilePath,'details/'.$strFileName.'.'.$arrPathInfo['extension'])){
        $strNewFilePath = '/avgPrice/main/details/'.$strFileName.'.'.$arrPathInfo['extension'];
        $strOldFilePath = filter_input(INPUT_POST,'filePath',FILTER_SANITIZE_STRING);

        // Обновляем сессию, если в ней участвует файл
        if (count($_SESSION['t']['avgPrice']['detailsForm'])){
            foreach ($_SESSION['t']['avgPrice']['detailsForm'] as $k => $arrRow){
                if ($arrRow['photo'] == $strOldFilePath){
                    $_SESSION['t']['avgPrice']['detailsForm'][$k]['photo'] = $strNewFilePath;
                }
            }
        }

        echo($strNewFilePath);
    }
}