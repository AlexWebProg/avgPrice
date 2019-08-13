<?php
// Загружаем новое фото детали
session_start();
$arrRes = array();

function img_resize($src, $dest, $width, $height, $rgb=0xFFFFFF, $quality=100){
    if (!file_exists($src)) return false;
    $size = getimagesize($src);
    if ($size === false) return false;
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
    $icfunc = "imagecreatefrom" . $format;
    if (!function_exists($icfunc)) return false;
    $x_ratio = $width / $size[0];
    $y_ratio = $height / $size[1];
    $ratio       = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);
    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
    $isrc = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);
    imagefill($idest, 0, 0, $rgb);
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0,
        $new_width, $new_height, $size[0], $size[1]);
    imagejpeg($idest, $dest, $quality);
    imagedestroy($isrc);
    imagedestroy($idest);
    return true;
}

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

// Имя файла
$strFilePath = 'details/'.translit($_FILES['file']['name']);

if(file_exists($strFilePath)){
    $arrRes['error'] = 'Файл '.$_FILES['file']['name']. ' уже существует. Пожалуйста, переименуйте загружаемый файл';
    $arrRes['result'] = 0;
}elseif (0 < $_FILES['file']['error']){
    $arrRes['error'] = 'Ошибка загрузки файла: '.$_FILES['file']['error'];
    $arrRes['result'] = 0;
}elseif($_FILES['file']['size'] > 49*1048576){ // Не больше 49 Мегабайт
    $arrRes['error'] = 'Размер загружаемого файла не должен превышать 49 Мегабайт';
    $arrRes['result'] = 0;
}elseif(!in_array($_FILES['file']['type'],array('image/png','image/jpeg'))){
    $arrRes['error'] = 'Допустимые форматы загружаемых файлов: JPG и PNG';
    $arrRes['result'] = 0;
}else{

    move_uploaded_file($_FILES['file']['tmp_name'], $strFilePath); // загружаем файл
    img_resize($strFilePath, $strFilePath, 500, 500); // изменяем размер

    $arrPathInfo = pathinfo($strFilePath); // Проверяем, существует ли файл и получаем информацию о нём
    if (!empty($arrPathInfo)){
        $arrRes = array('result' => 1, 'filePath' => '/avgPrice/main/'.$strFilePath, 'fileName' => $arrPathInfo['filename']);
    }else{
        $arrRes['error'] = 'Произошла неизвестная ошибка загрузки файла';
        $arrRes['result'] = 0;
    }

}
echo(json_encode($arrRes));



