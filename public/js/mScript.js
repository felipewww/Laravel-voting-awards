$(document).ready(function () {
    mScript.init();
});

mScript = {
    init: function ()
    {

    },

    createElement: function (element, innerHTML, attrs, styles)
    {
        if (typeof innerHTML == 'object') {
            attrs = innerHTML;
            innerHTML = '';
        }

        if (typeof attrs    != 'object' ) { attrs = {} }
        if (typeof styles   != 'object' ) { styles = {} }

        var e = document.createElement(element);
        e.innerHTML = innerHTML;

        for(var attr in attrs)
        {
            if (attr == 'onclick' && typeof attrs[attr] == 'function') {
                e.addEventListener('click', function (ev) {
                    return ev;
                }(attrs[attr]));
            }else{
                e.setAttribute(attr, attrs[attr]);
            }
        }

        for(var css in styles)
        {
            e.style[css] = styles[css];
        }

        return e;
    },
};