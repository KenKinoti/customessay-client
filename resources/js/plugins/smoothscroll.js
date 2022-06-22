$(document).ready(function () {
    let scroll = $("a.smooth-scroll");
    if (scroll.length > 0) {
        scroll.on('click', function (event) {
            if (this.hash !== "") {
                event.preventDefault();
                let hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top - 250
                }, 800);
            }
        });
    }
});