<link href="/avgPrice/main/css/style.css" rel="stylesheet"/>
<table class="pageHeader">
    <tr>
        <td>
            <h3>Средние цены</h3>
        </td>
        <td class="alignRight">
            <button class="btn btn-default clearForm" title="Очистить список деталей и выбранный шаблон и начать заново"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Очистить форму</button>
        </td>
    </tr>
</table>
<div class="panel panel-default">
    <div class="panel-heading taskHeader">
        <div class="row">
            <div class="marginLeft15 taskHeaderText">
                Шаг 1. Заполните список деталей:
            </div>
        </div>
    </div>
    <br/>
    <table class="table table-hover" style="border-bottom: 1px solid #ddd;">
        <thead>
        <tr>
            <th class="text-center text-nowrap">№ п/п</th>
            <th class="text-center text-nowrap">Фото</th>
            <th class="text-center text-nowrap">Артикул (код)</th>
            <th class="text-center text-nowrap">Название (на русском)</th>
            <th class="text-center text-nowrap">Description (на англ)</th>
            <th class="text-center text-nowrap">Производитель</th>
            <th class="text-center text-nowrap">Цена, р</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="detailsList">
            <?include_once('main/detailsList.php');?>
        </tbody>
    </table>
    <br/>
    <button id="addDetailToList" class="btn btn-primary marginLeft15" title="Добавить деталь в список"><i class="fa fa-plus" aria-hidden="true"></i> Добавить деталь</button>
    <br/><br/>
</div>

<hr/>
<div class="panel panel-default">
    <div class="panel-heading taskHeader">
        <div class="row">
            <div class="marginLeft15 taskHeaderText">
                Шаг 2. Выберите шаблон для отображения:
            </div>
        </div>
    </div>
    <br/>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Выбрать</th>
                <th class="templateImgTD">Внешний вид</th>
                <th>Описание</th>
            </tr>
        </thead>
        <tbody>
            <tr <?if($_SESSION['t']['avgPrice']['strTemplate'] == 'avtgr'){?>class="templateActiveRow"<?}?>>
                <td class="templateFormRadioTD">
                    <input type="radio" name="template" value="avtgr" class="templateForm" title="Выбрать шаблон www.avtgr.ru" <?if($_SESSION['t']['avgPrice']['strTemplate'] == 'avtgr'){?>checked="checked"<?}?>/>
                </td>
                <td>
                    <img src="/avgPrice/main/img/avtgr.jpg" class="templateIMG" title="Кликните, чтобы увеличить изображение" data-descr="Поиск по номеру детали на сайте www.avtgr.ru"/>
                </td>
                <td class="templateDescriptionTD">
                    Сайт: <a href="https://avtgr.ru/" target="_blank" title="Открыть сайт www.avtgr.ru в новой вкладке">www.avtgr.ru</a>
                    <br/>
                    Тип шаблона: поиск по номеру детали
                </td>
            </tr>
            <tr <?if($_SESSION['t']['avgPrice']['strTemplate'] == 'zapakpp'){?>class="templateActiveRow"<?}?>>
                <td class="templateFormRadioTD">
                    <input type="radio" name="template" value="zapakpp" class="templateForm" title="Выбрать шаблон www.zapakpp.ru" <?if($_SESSION['t']['avgPrice']['strTemplate'] == 'zapakpp'){?>checked="checked"<?}?>/>
                </td>
                <td>
                    <img src="/avgPrice/main/img/zapakpp.jpg" class="templateIMG" title="Кликните, чтобы увеличить изображение" data-descr="Каталог запчастей на сайте www.zapakpp.ru"/>
                </td>
                <td class="templateDescriptionTD">
                    Сайт: <a href="https://zapakpp.ru/" target="_blank" title="Открыть сайт www.zapakpp.ru в новой вкладке">www.zapakpp.ru</a>
                    <br/>
                    Тип шаблона: каталог запчастей
                </td>
            </tr>
            <tr <?if($_SESSION['t']['avgPrice']['strTemplate'] == 'avtzap'){?>class="templateActiveRow"<?}?>>
                <td class="templateFormRadioTD">
                    <input type="radio" name="template" value="avtzap" class="templateForm" title="Выбрать шаблон www.avt-zap.ru" <?if($_SESSION['t']['avgPrice']['strTemplate'] == 'avtzap'){?>checked="checked"<?}?>/>
                </td>
                <td>
                    <img src="/avgPrice/main/img/avtzap.jpg" class="templateIMG" title="Кликните, чтобы увеличить изображение" data-descr="Поиск по номеру детали на сайте www.avt-zap.ru"/>
                </td>
                <td class="templateDescriptionTD">
                    Сайт: <a href="https://avt-zap.ru" target="_blank" title="Открыть сайт www.avt-zap.ru в новой вкладке">www.avt-zap.ru</a>
                    <br/>
                    Тип шаблона: поиск по номеру детали
                </td>
            </tr>
        </tbody>
    </table>
</div>
<hr/>
<div>
    <div class="pull-left">
        <button class="btn btn-default clearForm" title="Очистить список деталей и выбранный шаблон и начать заново"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Очистить форму</button>
    </div>
    <div class="pull-right">
        <button id="showResult" class="btn btn-primary btn-lg" title="Открыть заполненный шаблон в новой вкладке"><i class="fa fa-check fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Сформировать страницу</button>
    </div>
</div>

<div class="modal fade" id="templateIMGViewModal" tabindex="-1" role="dialog">
    <div id="templateIMGViewContent" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="templateIMGViewTitle" class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <img id="templateIMGViewBigImage" src=""/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;Закрыть это окно</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="photoChooseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Выберите фото детали</h4>
            </div>
            <div id="photosList" class="modal-body">
                <?include_once('main/photosList.php');?>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <button id="uploadNewPhotoButton" type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Загрузить новое фото</button>
                    <button title="Убрать в списке деталей фото выбранной детали" id="removePhotoFromDetail" type="button" class="btn btn-danger " data-dismiss="modal"><span class="fa-stack"><i class="fa fa-camera fa-stack-1x"></i><i class="fa fa-ban fa-stack-2x text-danger"></i></span>&nbsp;Деталь без фото</button>
                </div>
                <div id="photoChooseHiddenButtons" class="pull-right">
                    С отмеченным:&nbsp;&nbsp;
                    <button id="editPhotoButton" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;Редактировать</button>
                    <button id="photoChooseAgreeButton" type="button" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Выбрать фото</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadNewPhotoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Выполняется загрузка нового фото...</h4>
            </div>
            <div id="uploadNewPhotoContent" class="modal-body">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPhotoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Редактирование фото</h4>
            </div>
            <div class="modal-body">
                <img id="editingPhotoSRC" src=""/>
                <hr/>
                <div class="form-inline text-center">
                    <div class="form-group">
                        <label for="exampleInputName2">Название фото:&nbsp;</label>
                        <input id="editingPhotoName" type="text" name="photoName" value="" placeholder="Название фото" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="closeEditPhotoModal" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;Закрыть это окно</button>
                <button id="deletePhotoButton" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Удалить фото</button>
                <button id="updatePhotoNameButton" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Сохранить информацию</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="checkFormErrorModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;Ошибка</h4>
            </div>
            <div class="modal-body">
                <div id="checkFormError" class="alert alert-danger"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;Закрыть это окно</button>
            </div>
        </div>
    </div>
</div>

<input type="file" id="chooseFile" value=""/>
<script type="text/javascript" src="/avgPrice/main/js/form.js"></script>
