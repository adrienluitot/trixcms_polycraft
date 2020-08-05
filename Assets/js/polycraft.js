$('.file-input input').on('change', function () {
    let fileName = $(this).val();
    if(fileName.length > 1) {
       fileName = fileName.split('\\').pop();
       $(this).closest('.file-input').find('label').html('<b>' + fileName + '</b> Sélectionné');
    }
});

$('.fake-select').on('click', function(e) {
    e.stopPropagation();
    $(this).toggleClass('active');
});
$('.fake-select .fake-option:not(.selected)').on('click', function() {
    $(this).parent().find('.fake-option').removeClass("active");
    $(this).addClass('active');
    $(this).parent().find('.fake-option.selected span').text($(this).text());
    $(this).closest('.pc-form.select').find('input').val($(this).attr('data-value'));
});
$(window).click(function () {
    $('.fake-select').removeClass('active');
});

