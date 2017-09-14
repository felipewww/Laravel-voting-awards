$(document).ready(function () {
    Ellection.init();
});

Ellection = {

    currentPage: null,
    text: null,
    hero: null,
    main: null,
    form: null,
    ulGaveta: null,
    inputs: null,
    pagesBar: null,
    hideSize: 50,
    initialTextMargin: null,
    start: true,
    mainBtn: null,

    init: function ()
    {
        for(var idx in ellectionInfo)
        {
            if (ellectionInfo.hasOwnProperty(idx))
            {
                var dbinfo      = ellectionInfo[idx];
                var jsonInfo    = Pages[idx];
                jsonInfo.db = dbinfo;
            }
        }

        this.mainBtn = $("#main-btn");
        this.gaveta = $gaveta = $('#gaveta');
        this.text = $('#category');
        this.form = $('#mainform');
        this.inputs = this.form.find('input');
        this.hero = $('#hero');
        this.ulGaveta = document.getElementById('ul-gaveta');//$('#ul-gaveta');
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
        this._gaveta();
        this._navButtons();

        //click no primeiro item
        this.pagesBar.find('li')[0].click();
    },

    _navButtons: function ()
    {
        var prev, next, length;

        length = Script.length(Pages);

        prev = document.getElementById('btn-previous');
        next = document.getElementById('btn-next');

        $(prev).on('click', function () {
            if (!prev.classList.contains('disabled')) {
                var goto;
                if (Ellection.currentPage == 0) {
                    goto = length - 1; //go to last element
                } else {
                    goto = parseInt(Ellection.currentPage - 1);
                }
                $(Ellection.pagesBar).find('li')[goto].click();
            }
        });

        $(next).on('click', function () {
            if (!next.classList.contains('disabled')) {
                var goto;
                if (Ellection.currentPage == length - 1) {
                    goto = 0;
                } else {
                    goto = parseInt(Ellection.currentPage + 1);
                }
                $(Ellection.pagesBar).find('li')[goto].click();
            }
        })
    },

    _gaveta: function () {
        Ellection.gaveta.hide();

        //Se for mobile, não usar class NANO
        gavetaClass = ( Script.isMobile() ) ? 'with-overflow' : 'nano';
        $gaveta = $('#gaveta');
        $gaveta.addClass(gavetaClass);

        $('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
            Ellection.gaveta.animate({width:'toggle'},1000,'easeInExpo', function () {
                Ellection.pagesBar.fadeToggle();
            });

            $(this).toggleClass('open');
        });

        // this.__gavetaItems();
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
        var placeholder = ['Indicado','Referência'];

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

    __share: function (catid) {
        var displayMethod = (Script.isMobile()) ? 'iframe' : 'popup';

        console.log('displayMethod', displayMethod);

        FB.ui({
            app_id: publicAppId,
            method: 'share',
            // mobile_iframe: mframe,
            mobile_iframe: true,
            cookie: true,
            xfbml: true,
            display: displayMethod,
            href: window.APP_URL+'/share/'+catid+'/'+shareToken,
        }, function(response){});
    },

    //Criar estrutura de LI da gaveta via JS
    __gavetaItems: function (item, itemPos)
    {

        console.log("Page is::", item);
        var allSet = !!(item.db.nominated);

        var li = document.createElement('li');
        li.setAttribute('id','cat_'+item.db.id);

        var title = document.createElement('div');
        title.setAttribute('class','title');

        //TODO - criar spans conforme quantidade de texto
        var categName = item.text.split('|');
        for(var idx in categName)
        {
            var cname = categName[idx];
            var cdiv = document.createElement('div');
            cdiv.innerHTML = cname;

            title.appendChild(cdiv);
        }

        var indicado = document.createElement('div');
        indicado.setAttribute('class','indicado');

        //TODO - nome do indicado ou texto padrão
        indicado.innerHTML = (allSet) ? item.db.nominated.name : 'Indicado';

        //Criar botão com transform
        var button = document.createElement('div');
        var btnClass = (allSet) ? 'share' : 'indicar';

        if (allSet) {
            button.onclick = function () {
                //alert('share!')
                Ellection.__share( item.db.id );
            }
        }else{
            button.onclick = function () {
                $('#nav-icon1').click();
                Ellection.pagesBar.find('li')[itemPos].click();
            }
        }

        button.setAttribute('class', 'button light '+btnClass);

        var button_span1 = document.createElement('span');

        var button_span2 = document.createElement('span');
        button_span2.setAttribute('class','_link');

        var button_span2_a = document.createElement('a');
        button_span2_a.setAttribute('href', '#');

        var button_span2_text = document.createElement('div');
        button_span2_text.innerHTML = (allSet) ? 'COMPARTILHAR' : 'INDICAR';

        button.appendChild(button_span1);

        button_span2.appendChild(button_span2_a);
        button_span2.appendChild(button_span2_text);

        button.appendChild(button_span2);

        //Ajustar estrutura da LI
        li.appendChild(title);
        li.appendChild(indicado);
        li.appendChild(button);

        this.ulGaveta.appendChild(li);
    },

    _setPageNavigation: function ()
    {
        var ul = document.createElement('ul');
        ul.setAttribute('id','nav');

        for(var i in Pages)
        {
            if (Pages.hasOwnProperty(i))
            {
                var page = Pages[i];

                this.__gavetaItems(page, i);

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

        if (obj.db.nominated) {

            this.inputs[0].value = obj.db.nominated.name;
            this.inputs[1].value = obj.db.nominated.reference;

            this.setAsBlocked(obj.db.id, obj);
        }
        else{
            this.inputs[0].value = 'Indicado';
            this.inputs[1].value = 'Referência';

            this.setAsEnabled();
        }

        //Inserir o texto do titulo em sequencia das divs
        // console.log('Para', paragraphs);
        var i = 0;
        while (i < 3){
            var pItem = Ellection.text.find('> div')[i];

            var str = ( paragraphs[i] ) ? paragraphs[i] : '';
            $(pItem).html(str);

            i++;
        }

        this.form.removeAttr('class');
        this.form.addClass(obj.formClass);
        this.hero.css("background-image","url(/site/media/images/"+obj.icon+")");
        this.main.css("background-color", obj.bgColor);
        this.main.css("borderColor", obj.mainBorderColor);

        var prev = document.getElementById('btn-previous');
        var next = document.getElementById('btn-next');

        prev.disble = false;
        prev.classList.remove("disabled");

        next.disble = false;
        next.classList.remove("disabled");

        console.log(Ellection.currentPage);
        if(Ellection.currentPage == 0){
            prev.disble = true;
            prev.classList.add("disabled");
        }

        if(Ellection.currentPage >= Script.length(Pages) -1){
            next.disble = true;
            next.classList.add("disabled");
        }
    },

    changePage: function (objectId)
    {

        if (this.currentPage == objectId) {
            return false;
        }

        this.currentPage = parseInt(objectId);

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
        var obj = Pages[this.currentPage];
        var catid = obj.db['id'];

        var name    = _this.inputs[0].value;
        var ref     = _this.inputs[1].value;

        var data = { cat: catid, name: name, ref: ref, _token: window.csrfToken };

        $.ajax({
            url: '/indicacao/envia',
            data: data,
            method: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    Script._modal('Voto computado com sucesso!');
                    obj.db['nominated'] = { name: name, reference: ref };
                    _this.setAsBlocked(catid, obj);
                }else{
                    Script._modal(data.message);
                }
            },
            error: function (data) {
                Script._modal('Erro inesperado. Tente novamente.');
                setTimeout(function () {
                    window.location.href="/";
                }, 400);
            }
        })
    },

    setAsBlocked: function (catid, obj)
    {
        //Encontrar a LI dentro da ul da gaveta
        var liID = 'cat_'+catid;
        var li = $(Ellection.ulGaveta).find('li[id="'+liID+'"]');

        var btn = $(li[0]).find('.button')[0];

        $(btn).removeClass('indicar');
        $(btn).addClass('share');
        $(btn).find('._link').first().find('div').first().html('COMPARTILHAR');

        btn.onclick = function () {
            Ellection.__share(catid);
        };

        $(li).find('.indicado').first().html(obj.db.nominated.name);
        // ./Gaveta

        //
        var txt = this.mainBtn.find('span')[1];
        txt = $(txt).find('div')[0];
        txt.innerHTML = "COMPARTILHAR";

        this.mainBtn[0].onclick = function () {

            console.log('is mobile?', Script.isMobile());
            console.log('Fullurl', window.APP_URL+'/share/'+catid+'/'+shareToken);
            var mframe = Script.isMobile();

            Ellection.__share(catid);
        };

        this.inputs.each(function () {
            $(this).attr('disabled','disabled');
        });
    },

    setAsEnabled: function ()
    {
        this.mainBtn[0].onclick = function () {
            Ellection.send();
        };

        var txt = this.mainBtn.find('span')[1];
        txt = $(txt).find('div')[0];
        console.log('TXT', txt);
        txt.innerHTML = 'INDICAR';

        this.inputs.each(function () {
            $(this).removeAttr('disabled');
        });


    }
};

function maskInit() {
    var categ = $('#category');
    var w = parseInt(categ.css("width"));
    var h = parseInt(categ.css("height"));
    var l = parseFloat(categ.css("left"));

    var masker = categ.find('.masker')[0];

    var totalLeft = (w*-1)+l;

    categ.css("width", w);
    categ.css("height", h);
    categ.css("left", totalLeft);
    categ.css("overflow", "hidden");

    masker.style.position="absolute";
    masker.style.left=w+"px";

    setTimeout(function () {
        Ellection.showMask(categ, masker, w, 20, l);

    }, 500);
}