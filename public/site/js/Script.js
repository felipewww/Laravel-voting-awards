$(document).ready(function () {
    Script.init();
});

Script = {

    loader_div: null,
    _modal_div: null,

    init: function ()
    {
        this.loader_div = document.getElementById('loader');
        this.content    = $('#content');
        this._modal_div = document.getElementById('_modal');

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
    },

    _modal: function (text)
    {
        var $modal = $(this._modal_div);
        $modal.html(text);
        $modal.slideDown();

        setTimeout(function () {
            $modal.slideUp();
        }, 5000)
    },

    length: function (obj) {
        var i = 0;
        for (var idx in obj){
            i++;
        }
        return i;
    }
};