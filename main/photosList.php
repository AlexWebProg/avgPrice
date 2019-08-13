<?php
// Список фото деталей для выбора
session_start();
$arrPhotos = array_diff(scandir($_SERVER['DOCUMENT_ROOT'] .'/avgPrice/main/details'), array('..', '.'));
?>
<div class="row">
    <?foreach ($arrPhotos as $strPhoto){$arrPathInfo = pathinfo('avgPrice/main/details/'.$strPhoto);?>
    <div class="col-md-2">
        <div class="thumbnail text-center detailPhoto">
            <img src="/avgPrice/main/details/<?=$strPhoto?>" alt="<?=$strPhoto?>">
            <br/><span><?=$arrPathInfo['filename']?></span>
        </div>
    </div>
    <?}?>
</div>