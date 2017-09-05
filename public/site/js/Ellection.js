$(document).ready(function () {
    Ellection.init();
});

Ellection = {

    currentPage: null,
    text: null,
    hero: null,
    main: null,
    form: null,
    inputs: null,
    pagesBar: null,
    hideSize: 50,
    initialTextMargin: null,
    start: true,

    init: function ()
    {
        for(var idx in ellectionInfo)
        {
            if (ellectionInfo.hasOwnProperty(idx))
            {
                var dbinfo      = ellectionInfo[idx];
                var jsonInfo    = Pages[idx];
                // console.log('IDX::', idx, Pages[idx]);
                jsonInfo.db = dbinfo;
            }
        }

        console.log(Pages);

        this.text = $('#category');
        this.form = $('#mainform');
        this.inputs = this.form.find('input');
        this.hero = $('#hero');
        this.main = $('#bg_main');
        this.pagesBar = $('#pagesBar');
        this.initialTextMargin = parseInt($(this.text).css('top'));

        //Primeiro acesso, clicar no primeiro item para carregar tela e efeitos.
        if (this.start) {
            this.start = false;

            $(this.form).hide();
            $(this.text).css('opacity',0);
            $(this.text).css('top', Ellection.initialTextMargin-100);

            Script.__intro();

            $(this.hero).css('opacity',0);
        }

        this._setPlaceholder();
        this._setPageNavigation();
        this._setNavbar();

        //click no primeiro item
        this.pagesBar.find('li')[0].click();
    },

    /*
    * via js por causa do VW
    * */
    _setNavbar: function ()
    {
        var h = parseInt(this.pagesBar.css('height'));
        this.pagesBar.css('marginTop', (h/2)*-1 );
    },

    _setPlaceholder: function ()
    {
        // var inputs = this.form.find('input');
        var placeholder = ['Indicado','Referência'];
        // console.log(inputs);

        this.inputs.each(function (i) {
            var input = $(this);

            input.val(placeholder[i]);
            _e(input[0], placeholder[i]);
        });

        function _e(input, placeholder) {
            input.addEventListener('focus', function () {
                if ( this.value == placeholder ) {
                    this.value = "";
                }
            });

            input.addEventListener('blur', function () {
                if ( this.value == "" ) {
                    this.value = placeholder;
                }

            })
        }
    },

    _setPageNavigation: function ()
    {
        var ul = document.createElement('ul');
        ul.setAttribute('id','nav');

        for(var i in Pages)
        {
            if (Pages.hasOwnProperty(i)) {
                var page = Pages[i];
                var li = document.createElement('li');
                li.style.backgroundImage = "url(/site/media/images/"+page.icon+")";
                setclick(li, i);

                ul.appendChild(li);
            }
        }

        function setclick(btn, i){
            btn.addEventListener('click', function () {
                $(this.parentNode).find('.active').removeAttr('class','active');
                this.setAttribute('class','active');
                Ellection.changePage(i);
            })
        }

        this.pagesBar[0].appendChild(ul);

    },

    /**
     * @Private - accessed from changePage()
     * */
    __hidePage: function () {
        // $(this.text).fadeOut();
        $(this.text).stop().animate({ top: Ellection.initialTextMargin-100, opacity: 0 }, 700, "easeInOutQuint");

        $(this.hero).stop().animate({ marginTop: -10, opacity: 0 }, 700, "easeInOutQuint");
    },

    /**
    * @Private - accessed from changePage()
    * */
    __showPage: function () {
        $(this.text).animate({ opacity: 1 }, 700).dequeue();
        $(this.text).animate({ top: Ellection.initialTextMargin }, 700, "easeInOutQuint");

        var h = parseInt($(this.hero).css('height'));

        $(this.hero).animate({ opacity: 1 }, 1000).dequeue();
        $(this.hero).animate({ marginTop: (h/2)*-1 }, 1000, "easeInOutQuint");

        $(this.form).fadeIn();
    },

    /**
     * @Private - accessed from changePage()
     * */
    __setPage: function (objectId)
    {
        var obj = Pages[objectId];
        var paragraphs = obj.text.split('|');

        // var inputs = this.form.find('input');
        if (obj.db.nominated) {

            this.inputs[0].value = obj.db.nominated.name;
            this.inputs[1].value = obj.db.nominated.reference;

            // this.inputs.each(function () {
            //     $(this).attr('disabled','disabled');
            // });
            this.setAsBlocked();
        }
        else{
            this.inputs[0].value = 'Indicado';
            this.inputs[1].value = 'Referência';

            this.inputs.each(function () {
                $(this).removeAttr('disabled');
            });
        }

        //Inserir o texto do titulo em sequencia das divs
        for(var idx in paragraphs){
            var pItem = Ellection.text.find('> div')[idx];
            $(pItem).html(paragraphs[idx]);
        }

        this.form.removeAttr('class');
        this.form.addClass(obj.formClass);
        this.hero.css("background-image","url(/site/media/images/"+obj.icon+")");
        this.main.css("background-color", obj.bgColor);
        this.main.css("borderColor", obj.mainBorderColor);
    },

    changePage: function (objectId) {

        if (this.currentPage == objectId) {
            return false;
        }

        this.currentPage = objectId;

        var _this = this;
        this.__hidePage();

        setTimeout(function () {
            _this.__setPage(objectId);
        }, 700);

        setTimeout(function () {
            _this.__showPage();
        }, 800)
    },

    showMask: function (main, masker, width, speed, maxLeft)
    {
        act(main, masker, width, speed, maxLeft);

        if (speed >= width) {
            speed = width;
        }

        setTimeout(function () {
            var nw = width - speed;
            Ellection.showMask(main, masker, nw, speed, maxLeft)
        }, 1);

        function act(main, masker, width, speed, maxLeft)
        {
            var currentLeft = parseInt($(main).css('left'));

            if ( (currentLeft + speed) > maxLeft ) {
                $(masker).css('left', 0);
                $(main).css('left', maxLeft);
                return;
            }

            $(masker).css('left', width - (speed+1));
            $(main).css('left', currentLeft + speed);
        }
    },

    send: function ()
    {
        var _this = this;
        var catid = Pages[this.currentPage].db['id'];
        var data = { cat: catid, name: _this.inputs[0].value, ref: _this.inputs[1].value, _token: window.csrfToken };

        console.log(data);

        $.ajax({
            url: '/indicacao/envia',
            data: data,
            method: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    Script._modal('Voto computado com sucesso!');
                    _this.setAsBlocked();
                }else{
                    Script._modal(data.message);
                }
            },
            error: function (data) {
                Script._modal('Erro inesperado. Tente novamente.');
            }
        })
    },

    setAsBlocked: function ()
    {
        this.inputs.each(function () {
            $(this).attr('disabled','disabled');
        });
    }
};

function maskInit() {
    var categ = $('#category');
    var w = parseInt(categ.css("width"));
    var h = parseInt(categ.css("height"));
    var l = parseFloat(categ.css("left"));

    // w = w+10;
    //l = l-20;

    console.log("W: ",w, "H: ", h, "L: ",l);

    var masker = categ.find('.masker')[0];

    var totalLeft = (w*-1)+l;

    categ.css("width", w);
    categ.css("height", h);
    categ.css("left", totalLeft);
    categ.css("overflow", "hidden");

    masker.style.position="absolute";
    masker.style.left=w+"px";

    console.log("TOTAL left: ",totalLeft);

    setTimeout(function () {
        Ellection.showMask(categ, masker, w, 20, l);
    }, 500);
}