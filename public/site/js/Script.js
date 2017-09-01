$(document).ready(function () {
    Script.init();
});

Script = {

    init: function ()
    {
        this.content = $('#content');
    },

    __intro: function () {
        var containerWidth = $(this.content).width();
        $(this.content).width('0');
        $(this.content).css('visibility','visible');
        $(this.content).animate({width: containerWidth}, 700, "easeInCirc");
    }
};