$(function () {
    const header = $("#pageNav");

    if (header.length > 0) {
        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";

        $(window).on("load resize", function () {
            if (this.matchMedia("(min-width: 768px)").matches) {
                $dropdown.hover(
                    function () {
                        const $this = $(this);
                        $this.addClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "true");
                        $this.find($dropdownMenu).addClass(showClass);
                    },
                    function () {
                        const $this = $(this);
                        $this.removeClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "false");
                        $this.find($dropdownMenu).removeClass(showClass);
                    }
                );
            } else {
                $dropdown.off("mouseenter mouseleave");
            }
        });

        $(window).scroll(function () {
            fixNavBar();
        });

        fixNavBar();

        function fixNavBar() {
            let scroll = $(window).scrollTop();
            if (scroll > 130) {
                header.addClass("sticky");
            } else {
                header.removeClass("sticky");
            }
        }
    }
});

 $(".clicky").click(function(){
    $(".expandy").slideToggle();
  });