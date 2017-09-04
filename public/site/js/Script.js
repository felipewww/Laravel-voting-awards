$(document).ready(function () {
    Script.init();
});

Script = {

    loader_div: null,

    init: function ()
    {
        this.loader_div = document.getElementById('loader');
        this.content = $('#content');
    },

    __intro: function () {
        var containerWidth = $(this.content).width();
        $(this.content).width('0');
        $(this.content).css('visibility','visible');
        $(this.content).animate({width: containerWidth}, 700, "easeInCirc");
    },

    loader: function (act) {
        if (act == 'show') {
            $(this.loader_div).fadeIn();
        }else if(act == 'hide'){
            $(this.loader_div).fadeOut();
        }
    }
};