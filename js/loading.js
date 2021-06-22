function Loading() {

    var opts = {
        lines: 13, // The number of lines to draw
        length: 20, // The length of each line
        width: 10, // The line thickness
        radius: 30, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#000', // #rgb or #rrggbb or array of colors
        speed: 3, // Rounds per second
        trail: 10, // Afterglow percentage
        shadow: true, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: '50%', // Top position relative to parent
        left: '50%' // Left position relative to parent
    };
    //var target = document.getElementById('carregando');
    //spinner = new Spinner(opts).spin(target);  

    var modal_opts = {
        lines: 13, // The number of lines to draw
        length: 20, // The length of each line
        width: 10, // The line thickness
        radius: 30, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        direction: 1,
        rotate: 4, // The rotation offset
        color: '#FFF', // #rgb or #rrggbb
        speed: 3, // Rounds per second
        trail: 30, // Afterglow percentage
        shadow: true, // Whether to render a shadow
        hwaccel: true, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: '50%', // Top position relative to parent in px
        left: '50%' // Left position relative to parent in px
    };

    //jQuery extension
    $.fn.spin = function (opts) {
        if (opts == null)
            opts = default_opts;
        if (opts == "modal")
            opts = modal_opts;

        this.each(function () {
            var $this = $(this),
                    data = $this.data();

            if (data.spinner) {
                data.spinner.stop();
                delete data.spinner;
                if (opts == modal_opts)
                    $("#spin_modal_overlay").remove();
                return this;
            }

            var spinElem = this;
            if (opts == modal_opts) {
                $('body').append('<div id="spin_modal_overlay" style="background-color: rgba(0, 0, 0, 0.6); width:100%; height:100%; position:fixed; top:0px; left:0px; z-index:' + (opts.zIndex - 1) + '"/>');
                spinElem = $("#spin_modal_overlay")[0];
            }
            data.spinner = new Spinner($.extend({color: $this.css('color')}, opts)).spin(spinElem);
        });
        return this;
    };

    $('#carregando').spin("modal");
}

function CloseLoading() {

    $('#carregando').spin("modal");
}