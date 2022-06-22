function calculateSimple() {
    let pages = 1;
    let deadline = $('#deadline').val();
    let level = 2;

    let amount = 0;

    let deadlineId = "#essayL" + level + "D" + deadline;
    amount = Number(amount) + Number($(deadlineId).val()) * pages;

    $('.amount').html(amount);
}


$(function () {
    $("#deadline").change(function () {
        calculateSimple();
    });

    calculateSimple();
});