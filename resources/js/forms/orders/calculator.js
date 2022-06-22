function calculate() {
    const deadline = $("#pageDeadline");
    let deadlineId = deadline.val();
    let type = deadline.find(":selected").data('type');
    let value = deadline.find(":selected").data('value');

    let level = $('input[name=academic_level_id]').val();
    let pages = Number($('#pages').val());
    let spacing = $('input[name=spacing]:checked').val();

    let plagiarism = $('input[name=plagiarism]').is(':checked');
    let grammar = $('input[name=grammar]').is(':checked');

    let charts = Number($('#charts').val());
    let writer = $('#preferred_writer').val();
    let ppt_slides = Number($('#ppt_slides').val());
    let enl = $('input[name=requires_enl_writer]').val();
    let technical = $('#discipline_id option:selected').data('technical');
    let digital = $('input[name=requires_digital_references]').is(':checked');

    let amount = 0;

    if (pages > 0) {
        if (spacing === 'single') {
            pages *= 2;
        }

        let key = "essayL" + level + "D" + deadlineId;
        let cpp = window.prices[key];
        let pagesAmount = Number(cpp) * pages;
        amount += pagesAmount;

        $(".pages").show();
        $(".pages .description").text(pages + ' page(s) x $' + cpp);
        $(".pages .amount").text(pagesAmount);
    } else {
        $(".pages").hide();
    }

    if (ppt_slides > 0) {
        let key = "presentationL" + level + "D" + deadlineId;
        let pptPrice = window.prices[key];
        let totalPptPrice = pptPrice * ppt_slides;

        amount += totalPptPrice;

        $("#speakerNotes").show();
        $(".slides").show();
        $(".slides .description").text(ppt_slides + ' slide(s) x $' + pptPrice);
        $(".slides .amount").text(totalPptPrice);
    } else {
        $(".slides").hide();
        $("#speakerNotes").hide();
    }

    if (charts > 0) {
        let key = "chartL" + level + "D" + deadlineId;
        let chartPrice = window.prices[key];
        let totalChartPrice = chartPrice * charts;

        amount += totalChartPrice;

        $(".charts").show();
        $(".charts .description").text(charts + ' chart(s) x $' + chartPrice);
        $(".charts .amount").text(totalChartPrice);
    } else {
        $(".charts").hide();
    }

    if (writer) {
        let key = "preferred-writerL" + level + "D" + deadlineId;
        let writerPrice = window.prices[key];
        amount += Number(writerPrice);

        $(".preferred-writer").show();
        $(".preferred-writer .amount").text(writerPrice);
    } else {
        $(".preferred-writer").hide();
    }

    if (Boolean(digital)) {
        let key = "digital-sourcesL" + level + "D" + deadlineId;
        let digitalSourcesPrice = window.prices[key];
        amount += Number(digitalSourcesPrice);

        $(".digital-sources").show();
        $(".digital-sources .amount").text(digitalSourcesPrice);
    } else {
        $(".digital-sources").hide();
    }

    if (enl === '1') {
        let key = "enl-writerL" + level + "D" + deadlineId;
        let enlWriterPrice = (pages + ppt_slides) * window.prices[key];
        amount += enlWriterPrice;

        $(".advanced-writer").show();
        $(".advanced-writer .amount").text(enlWriterPrice);
    } else {
        $(".advanced-writer").hide();
    }

    if (Boolean(technical)) {
        let key = "technical-paperL" + level + "D" + deadlineId;
        let technicalPrice = window.prices[key];

        let totalTechnical = (pages + ppt_slides) * technicalPrice;
        amount += Number(totalTechnical);

        $(".technical").show();
        $(".technical .amount").text(totalTechnical);
    } else {
        $(".technical").hide();
    }

    if (Boolean(grammar)) {
        let key = "grammar-reportL" + level + "D" + deadlineId;
        let grammarPrice = window.prices[key];

        amount += Number(grammarPrice);

        $(".grammar").show();
        $(".grammar .amount").text(grammarPrice);
    } else {
        $(".grammar").hide();
    }

    if (Boolean(plagiarism)) {
        let key = "plagiarism-reportL" + level + "D" + deadlineId;
        let plagiarismPrice = window.prices[key];

        amount += Number(plagiarismPrice);

        $(".plagiarism").show();
        $(".plagiarism .amount").text(plagiarismPrice);
    } else {
        $(".plagiarism").hide();
    }

    let deliveryDate = moment().add(value, type);
    let date = deliveryDate.format('MMM, D YYYY');
    let time = deliveryDate.format('h:mm A');
    let phrase = date + ' at ' + time;

    let words = 300 * pages + " words";

    $('#orderWords').text(words);
    $('#orderDeliveryDate').text(phrase);

    let totalAmount = $("#totalAmount");
    totalAmount.val(amount);

    $('.totalPrice').text(amount.formatMoney());
}

$(function () {
    if ($("#orderForm").length > 0) {
        $("#pages, input[name=spacing], #pageDeadline, #preferred_writer, #ppt_slides, #charts, " +
            "input[name=academic_level_id], input[name=requires_digital_references], " +
            "input[name=requires_enl_writer], input[name=plagiarism], input[name=grammar], #discipline_id," +
            " #coupon_code").change(function () {

            calculate();
        });

        calculate();
    }
});
