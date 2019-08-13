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
    <title>AVTZAP</title>
    <link href="../font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="stylesheet.css" rel="stylesheet">
    <script type="text/javascript" src="../js/html2canvas.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="pageContent">
            <div id="content">
                <img src="header.jpg">
                    <?
                    if (count($_SESSION['t']['avgPrice']['detailsForm'])){
                    foreach ($_SESSION['t']['avgPrice']['detailsForm'] as $arrRow){
                    ?>
                        <div class="detailBlock">
                            <div class="available">в наличии</div>
                            <table class="detailTable">
                                <tr>
                                    <td style="width:145px;"><img src="<?=$arrRow['photo']?>" class="detailsTablePhoto"/></td>

                                    <td>
                                        <table class="detailTable" style="border-bottom: 1px solid #e0e4f6;margin-top:15px;">
                                            <tr>
                                                <td class="greyText" style="width:225px;">НАЗВАНИЕ</td>
                                                <td class="greyText hPadding" style="width:225px;">Тех. описание</td>
                                                <td class="greyText hPadding" style="width:140px;">Производитель</td>
                                                <td class="greyText hPadding" style="width:120px;">Цена</td>
                                                <td class="greyText hPadding" style="width:70px;">Кол-во</td>
                                                <td class="greyText hPadding">Сумма</td>
                                            </tr>
                                            <tr>
                                                <td class="uppercase detailName"><?=$arrRow['name']?></td>
                                                <td class="uppercase hPadding"><?=$arrRow['description']?></td>
                                                <td class="uppercase hPadding"><?=$arrRow['manufacturer']?></td>
                                                <td class="hPadding">
                                                    <span class="price"><?=$arrRow['price']?> <i class="fa fa-rub" aria-hidden="true"></i></span>
                                                    <br/>
                                                    <span class="link">тип цены: Опт А</span>
                                                </td>
                                                <td class="hPadding"><img src="cntIcon.jpg"></td>
                                                <td class="hPadding"><span class="price"><?=$arrRow['price']?> р.</span></td>
                                            </tr>
                                        </table>
                                        <table class="detailTable" style="margin:5px 0;">
                                            <tr>
                                                <td class="bottomText">
                                                    <span class="greyText">Артикул:</span> <span class="uppercase"><?=$arrRow['part_number']?></span>
                                                </td>
                                                <td class="greyText bottomText">Тех.Номер:</td>
                                                <td class="greyText bottomText">Тех. характер.:</td>
                                                <td class="greyText" style="text-align:right;padding-right:26px;width:100%;"><i class="fa fa-heart-o" aria-hidden="true"></i></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?}}?>
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
                a.download = 'avtzap-'+today+'.jpg';
                a.click();
            });
        })
    </script>

</body>
</html>