$(function () {
    $('.data-options-link').click(function () {
        var parent = $(this).parent();
        parent.next('.data-options').removeClass('hide');
    })
});