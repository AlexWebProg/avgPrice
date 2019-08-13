<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ZAPAKPP</title>
    <link href="../font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="stylesheet.css" rel="stylesheet">
    <script type="text/javascript" src="../js/html2canvas.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="pageContent">
            <div id="content">
                <img src="header.jpg" style="padding:0;margin:0 0 2px 0;">
                <table id="detailsTable">
                    <thead>
                        <tr>
                            <th><img src="photoIcon.jpg"></th>
                            <th>Артикул</th>
                            <th>Название</th>
                            <th>Тех. описание</th>
                            <th>Производитель</th>
                            <th>Цена</th>
                            <th>Заказ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?
                    if (count($_SESSION['t']['avgPrice']['detailsForm'])){
                    foreach ($_SESSION['t']['avgPrice']['detailsForm'] as $arrRow){
                    ?>
                        <tr>
                            <td>
                                <img src="<?=$arrRow['photo']?>" class="detailsTablePhoto"/>
                            </td>
                            <td class="uppercase blueFont">
                                <?=$arrRow['part_number']?>
                            </td>
                            <td class="uppercase blueFont">
                                <?=$arrRow['name']?>
                            </td>
                            <td class="uppercase"><?=$arrRow['description']?></td>
                            <td class="uppercase"><?=$arrRow['manufacturer']?></td>
                            <td class="price"><?=number_format($arrRow['price'], 0, '', ' ')?> руб.</td>
                            <td><img src="orderIcon.jpg"></td>
                            <td class="blueFont">Купить</td>
                        </tr>
                    <?}}?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="techPlace">
            <div id="techButtonPlace">
                <button id="makeScreenShot" title="Сохранить полученную страницу как изображение"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;<i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;&nbsp;Сохранить как изображение</button>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        document.getElementById("makeScreenShot").addEventListener('click', function(){
            html2canvas(document.getElementById("content"), {scale: 1}).then(canvas => {
                var a = document.createElement('a');
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;
                a.href = canvas.toDataURL();
                a.download = 'zapakpp-'+today+'.jpg';
                a.click();
            });
        })
    </script>

</body>
</html>