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
    <title>AVTGR</title>
    <link href="../font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="stylesheet.css" rel="stylesheet">
    <script type="text/javascript" src="../js/html2canvas.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="pageContent">
            <div id="content">
                <img src="header.jpg" style="padding:0;margin:0 0 10px 0;">
                <table id="detailsTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="paddingLeft5">КОД</th>
                            <th class="paddingLeft20">НАИМЕНОВАНИЕ</th>
                            <th class="paddingLeft20">ОПИСАНИЕ</th>
                            <th class="paddingLeft20">ПРОИЗВОДИТЕЛЬ</th>
                            <th class="paddingLeft20">НАЛИЧИЧЕ</th>
                            <th class="paddingLeft20">ЦЕНА</th>
                            <th class="paddingLeft20">КУПИТЬ</th>
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
                            <td class="uppercase nowrap paddingLeft5">
                                <?=$arrRow['part_number']?>
                            </td>
                            <td class="detailName paddingLeft20 uppercase">
                                <?=$arrRow['name']?>
                            </td>
                            <td class="paddingLeft20"><?=$arrRow['description']?></td>
                            <td class="uppercase paddingLeft20"><?=$arrRow['manufacturer']?></td>
                            <td>
                                в наличии
                                <br/>
                                <span class="filial">Москва</span>
                            </td>
                            <td class="paddingLeft20 nowrap"><?=$arrRow['price']?> <i class="fa fa-rub" aria-hidden="true"></i></td>
                            <td class="paddingLeft20"><img src="basket.jpg"></td>
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
            a.download = 'avtgr-'+today+'.jpg';
            a.click();
        });
        })
    </script>

</body>
</html>