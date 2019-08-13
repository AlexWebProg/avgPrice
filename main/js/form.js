/* Увеличиваем картинку шаблона для отображения списка деталей */
$('.templateIMG').click(function(){
    $('#templateIMGViewModal').modal('show');
    $('#templateIMGViewTitle').text($(this).attr('data-descr'));
    $('#templateIMGViewBigImage').attr('src',$(this).attr('src'));
});

/* Выбираем шаблон для отображения списка деталей */
$('.templateForm').click(function(){
    $('.templateActiveRow').removeClass('templateActiveRow');
    $(this).closest('tr').addClass('templateActiveRow');
    $.post("/avgPrice/main/templateChoose.php", {'strTemplate':$(this).val()});
});

/* Заполняем столбец "№ п/п" таблицы деталей */
function updateRowNumbers(){
    var i = 1;
    $("#detailsList").find("tr").each(function(){
        $(this).find("td:eq(0)").text(i);
        i++;
    });
}
$().ready(function(){
    updateRowNumbers();
});

$("#detailsList")
    .on("change", ".detailsForm", function() { /* Обновялем сессию - список деталей при изменении любого поля формы */
        $.post("/avgPrice/main/detailsListUpdate.php", $('.detailsForm').serialize());
    })
    .on("click", ".detailsFormRemoveIcon", function() { /* Удаляем деталь из списка */
        $(this).closest('tr').remove();
        $.post("/avgPrice/main/detailsListUpdate.php", $('.detailsForm').serialize());
        updateRowNumbers();
    }).on("click", ".detailsFormPhotoIcon", function() { /* Открываем окно выбора фото, если у детали ещё нет фото */
        $('#photoChooseModal').modal('show');
        $('#detailPhotoActive').attr('id','');
        $('#photoChooseHiddenButtons').hide();
        $('#detailsFormPhotoEditing').attr('id','');
        $(this).attr('id','detailsFormPhotoEditing');
    }).on("click", ".detailsFormPhoto", function() { /* Открываем окно выбора фото, если у детали уже есть фото */
        $('#photoChooseModal').modal('show');
        $('#detailPhotoActive').attr('id','');
        $('.detailPhoto').find('img[src="'+$(this).attr('src')+'"]').closest('.detailPhoto').attr('id','detailPhotoActive');
        $('#photoChooseHiddenButtons').show();
        $('#removePhotoFromDetail').show();
        $('#detailsFormPhotoEditing').attr('id','');
        $(this).attr('id','detailsFormPhotoEditing');
    });

/* Добавляем строку в список деталей */
$('#addDetailToList').click(function(){
    $.get('/avgPrice/main/detailsListAddRow.html', function(result) {
        $('#detailsList').append(result);
        updateRowNumbers();
    });
});

/* Выбор фото  в модальном окне фотографий */
$('#photosList')
    .on("click", ".detailPhoto", function() {
        $('#detailPhotoActive').attr('id','');
        $(this).attr('id','detailPhotoActive');
        $('#photoChooseHiddenButtons').show();
    }).on("click", "#detailPhotoActive", function() { /* Имитируем двойной клк по фото: При клике активного оно становится фото детали в списке */
        $('#photoChooseAgreeButton').click();
    });

/* Изменяем фото детали в списке */
$('#photoChooseAgreeButton').click(function(){
    var image = $('#detailPhotoActive').find('img').attr('src');
    if (!image){
        alert('Не выбрано фото');
    }else{
        $('#photoChooseModal').modal('hide');
        $('#detailsFormPhotoEditing').closest('td').html('<img src="'+image+'" class="detailsFormPhoto"><input type="hidden" name="photo[]" value="'+image+'" class="detailsForm"/>');
        $.post("/avgPrice/main/detailsListUpdate.php", $('.detailsForm').serialize());
    }
});

/* Убираем фото детали в списке */
$('#removePhotoFromDetail').click(function(){
    $('#detailsFormPhotoEditing').closest('td').html('<i class="fa fa-camera fa-2x detailsFormPhotoIcon" title="Выбрать фото" aria-hidden="true"></i><input type="hidden" name="photo[]" value="" class="detailsForm"/>');
    $.post("/avgPrice/main/detailsListUpdate.php", $('.detailsForm').serialize());
});

/* Загрузка нового фото */
$('#uploadNewPhotoButton').click(function(){
    $('#chooseFile').click();
});
$('#chooseFile').change(function(){
    if ($(this).val() != ''){
        $('#uploadNewPhotoModal').modal('show');
        $('#uploadNewPhotoContent').html('<img src="/img/indicatorBig.gif" style="width:100px;margin:0 auto;"/>');
        var file_data = $('#chooseFile').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: '/avgPrice/main/uploadPhoto.php',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(arrRes){
                switch (arrRes.result){
                    case 0:
                        var output =  'Возникли следующие ошибки: <ul style="margin-left:30px;"><li>'+arrRes.error.join('</li><li>')+'</ol>';
                        $('#uploadNewPhotoContent').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '+output+"</div>");
                        break;
                    case 1:
                        $('#chooseFile').val('');
                        $('#uploadNewPhotoModal').modal('hide');
                        $('#editPhotoModal').modal('show');
                        $('#editingPhotoSRC').attr('src',arrRes.filePath);
                        $('#editingPhotoName').val(arrRes.fileName);
                        $('#photosList').load('/avgPrice/main/photosList.php');
                        break;
                }
            }
        });
    }
});

/* Окно редактирования фото */
$('#editPhotoButton').click(function(){
    var detailPhotoActive = $('#detailPhotoActive'),
        image = detailPhotoActive.find('img').attr('src'),
        name = detailPhotoActive.find('span').text();
    $('#editPhotoModal').modal('show');
    $('#editingPhotoSRC').attr('src',image);
    $('#editingPhotoName').val(name);
});
$('#editPhotoModal').on('shown.bs.modal', function () {
    $('#editingPhotoName').focus()
});

/* Изменение названия фото */
$('#updatePhotoNameButton').click(function(){
    var filePath = $('#editingPhotoSRC').attr('src'),
        fileName = $('#editingPhotoName').val();
    $.post("/avgPrice/main/updatePhotoName.php", {filePath:filePath, fileName:fileName}, function(newFilePath) {
        if (newFilePath){
            $('#photosList').load('/avgPrice/main/photosList.php', function() {
                $('.detailPhoto').find('img[src="'+newFilePath+'"]').closest('.detailPhoto').attr('id','detailPhotoActive');
            });
        }
        $('#photoChooseModal').modal('show');
        $('#photoChooseHiddenButtons').show();
    });
});

/* Закрытие окна редактирования фото */
$('#closeEditPhotoModal').click(function(){
    $('#photoChooseModal').modal('show');
});

/* Удаление фото */
$('#deletePhotoButton').click(function(){
    var filePath = $('#editingPhotoSRC').attr('src'),
        detailsFormPhotoEditing = $('#detailsList').find('img[src="'+filePath+'"]');
    $.post("/avgPrice/main/deletePhoto.php", {filePath:filePath}, function() {
        $('#photosList').load('/avgPrice/main/photosList.php');
        $('#photoChooseHiddenButtons').hide();
        $('#photoChooseModal').modal('show');
        if (detailsFormPhotoEditing.attr('id') == 'detailsFormPhotoEditing'){
            detailsFormPhotoEditing.closest('td').html('<i id="detailsFormPhotoEditing" class="fa fa-camera fa-2x detailsFormPhotoIcon" title="Выбрать фото" aria-hidden="true"></i><input type="hidden" name="photo[]" value="" class="detailsForm"/>');
        }else{
            detailsFormPhotoEditing.find('img[src="'+filePath+'"]').closest('td').html('<i class="fa fa-camera fa-2x detailsFormPhotoIcon" title="Выбрать фото" aria-hidden="true"></i><input type="hidden" name="photo[]" value="" class="detailsForm"/>');
        }
    });
});

/* Очистка формы */
$('.clearForm').click(function(){
    $.post("/avgPrice/main/clearForm.php", function() {
        location.reload();
    });
});

/* Формирование результатов */
$('#showResult').click(function(){
    $.post("/avgPrice/main/checkForm.php", function(arrRes) {
        switch (arrRes.result){
            case 0:
                var output =  'Возникли следующие ошибки: <ul style="margin-left:10px;"><li>'+arrRes.error.join('</li><li>')+'</ol>';
                $('#checkFormError').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '+output);
                $('#checkFormErrorModal').modal('show');
                break;
            case 1:
                window.open(arrRes.url);
                break;
        }
    },'json');
});