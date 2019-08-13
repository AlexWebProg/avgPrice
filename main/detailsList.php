<?php
// Список деталей для отображения
session_start();
if (empty($_SESSION['t']['avgPrice']['detailsForm'])) $_SESSION['t']['avgPrice']['detailsForm'] = array();
if (count($_SESSION['t']['avgPrice']['detailsForm'])){
    foreach ($_SESSION['t']['avgPrice']['detailsForm'] as $arrRow){
        ?>
        <tr>
            <td class="text-center">
            </td>
            <td class="text-center">
                <?if (empty($arrRow['photo'])){?>
                <i class="fa fa-camera fa-2x detailsFormPhotoIcon" title="Выбрать фото" aria-hidden="true"></i>
                <?}else{?>
                <img src="<?=$arrRow['photo']?>" class="detailsFormPhoto"/>
                <?}?>
                <input type="hidden" name="photo[]" value="<?=$arrRow['photo']?>" class="detailsForm"/>
            </td>
            <td>
                <input type="text" name="part_number[]" value="<?=$arrRow['part_number']?>" placeholder="Номер запчасти" class="form-control detailsForm"/>
            </td>
            <td>
                <input type="text" name="name[]" value="<?=$arrRow['name']?>" placeholder="Наименование (рус)" class="form-control detailsForm"/>
            </td>
            <td>
                <input type="text" name="description[]" value="<?=$arrRow['description']?>" placeholder="Description (англ)" class="form-control detailsForm"/>
            </td>
            <td>
                <input type="text" name="manufacturer[]" value="<?=$arrRow['manufacturer']?>" placeholder="Производитель" class="form-control detailsForm"/>
            </td>
            <td>
                <input type="number" name="price[]" value="<?=$arrRow['price']?>" placeholder="Цена, р" class="form-control detailsForm detailsFormPriceField"/>
            </td>
            <td class="text-center detailsFormVAlignMiddle">
                <i class="fa fa-times detailsFormRemoveIcon" title="Убрать деталь из списка" aria-hidden="true"></i>
            </td>
        </tr>
        <?
    }
}else{
    include_once('detailsListAddRow.html');
}