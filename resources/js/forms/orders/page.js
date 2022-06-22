$(function () {
    if ($("#pageCalculator").length !== 0) {
        $("#pagePages, #pageDeadline, #pageAcademicLevel, #pageCharts, #pageSlides, input[name=requireEnlWriter]").change(function () {
            calculateSimple();
        });

        calculateSimple();

        function calculateSimple() {
            let level = $('#pageAcademicLevel').val();

            const deadline = $("#pageDeadline");
            let deadlineId = deadline.val();
            let type = deadline.find(":selected").data('type');
            let value = deadline.find(":selected").data('value');

            let pages = Number($('#pagePages').val());
            let charts = Number($('#pageCharts').val());
            let slides = Number($('#pageSlides').val());

            let enl = $('input[name=requireEnlWriter]:checked').val();

            let amount = 0;

            if (pages > 0) {
                let key = "essayL" + level + "D" + deadlineId;
                amount += Number(window.prices[key]) * pages;
            }

            if (slides > 0) {
                let key = "presentationL" + level + "D" + deadlineId;
                amount += Number(window.prices[key]) * slides;
            }

            if (charts > 0) {
                let key = "chartL" + level + "D" + deadlineId;
                amount += Number(window.prices[key]) * charts;
            }

            if (enl === '1') {
                let key = "enl-writerL" + level + "D" + deadlineId;
                amount += ((pages + slides) * Number(window.prices[key]));
            }

            let deliveryDate = moment().add(value, type);
            let date = deliveryDate.format('MMM, D YYYY');
            let time = deliveryDate.format('h:mm A');
            let phrase = date + ' at ' + time;

            let words = 300 * pages + " words";

            $('#pageDeliveryDate').html(phrase);
            $('#pageWords').html(words);
            $('#pagePrice').text(amount.formatMoney());
        }
    }
});
