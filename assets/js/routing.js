$(document).ready(() => {
    $('#page').load('templates/oferta.php');
    $('#oferta').addClass('active').attr('aria-current', 'page');

    $('.nav-link').click((event) => {
        event.preventDefault();
        const page = 'templates/' + $(this).attr('id') + '.php';
        $('#page').load(page);
        $('.nav-link').removeClass('active').removeAttr('aria-current');
        $(this).addClass('active').attr('aria-current', 'page');
    });
});
