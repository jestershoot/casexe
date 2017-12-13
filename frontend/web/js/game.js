$('body').on('click', '.prize-action', function (e) {
    e.preventDefault();

    $.get($(this).attr('href'), function (data) {
        $('.prize-wrapper').html(data);
    })
});