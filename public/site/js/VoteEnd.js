$(document).ready(function () {
   VoteEnd.init();
});

VoteEnd = {

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
    logo: null,
    reqUL: null,

    init: function ()
    {
        for(var idx in ellectionInfo)
        {
            if (ellectionInfo.hasOwnProperty(idx))
            {
                var dbinfo      = ellectionInfo[idx];
                var jsonInfo    = Pages[idx];
                // console.log(ellectionInfo);
                jsonInfo.icon = dbinfo.icon;
                jsonInfo.text = dbinfo.name;
                jsonInfo.db = dbinfo;
            }
        }

        this.mainBtn = $("#main-btn");
        this.gaveta = $gaveta = $('#gaveta');
        this.text = $('#category');
        // this.form = $('#mainform');
        // this.inputs = this.form.find('input');
        this.hero = $('#hero');
        this.logo = $('#logo');
        this.ulGaveta = document.getElementById('ul-gaveta');//$('#ul-gaveta');
        this.main = $('#bg_main');
        this.pagesBar = $('#pagesBar');
        this.initialTextMargin = parseInt($(this.text).css('top'));
        this.reqUL = document.getElementById("requl");

        //Primeiro acesso, clicar no primeiro item para carregar tela e efeitos.
        if (this.start) {
            this.start = false;

            // $(this.form).hide();
            $(this.text).css('opacity',0);
            $(this.text).css('top', VoteEnd.initialTextMargin-100);
            // $(this.text).css('top', 100);

            Script.__intro();

            $(this.hero).css('opacity',0);
        }

        this._setPageNavigation();
        this._setNavbar();
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
                if (VoteEnd.currentPage == 0) {
                    goto = length - 1; //go to last element
                } else {
                    goto = parseInt(VoteEnd.currentPage - 1);
                }
                $(VoteEnd.pagesBar).find('li')[goto].click();
            }
        });

        $(next).on('click', function () {
            if(VoteEnd.avoidLoseVote){
                var indicado = VoteEnd.inputs[0].value;
                Script._modal('Clique em INDICAR para finalizar a indicação de "'+indicado+'" ou em próximo para ignorar esta indicação.', 10000);
                VoteEnd.mainBtn.effect('shake');
                VoteEnd.avoidLoseVote = false;
                return false;
            }
            if (!next.classList.contains('disabled')) {
                var goto;
                if (VoteEnd.currentPage == length - 1) {
                    goto = 0;
                } else {
                    goto = parseInt(VoteEnd.currentPage + 1);
                }
                $(VoteEnd.pagesBar).find('li')[goto].click();
            }
        })
    },

    /*
     * via js por causa do VW
     * */
    _setNavbar: function ()
    {
        var h = parseInt(this.pagesBar.css('height'));
        this.pagesBar.css('marginTop', (h/2)*-1 );
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
                var name = page.db.name.replace('|'," ");

                var li = document.createElement('li');
                li.style.backgroundImage = "url(/site/media/images/"+page.icon+")";

                if (!Script.isMobile())
                {
                    var tooltip = document.createElement('span');
                    tooltip.setAttribute('class','ref-tooltip2');
                    tooltip.setAttribute('title', name );
                    li.appendChild(tooltip);
                }

                setclick(li, i);

                ul.appendChild(li);
            }
        }

        function setclick(btn, i){
            btn.addEventListener('click', function () {
                $(this.parentNode).find('.active').removeAttr('class','active');
                this.setAttribute('class','active');
                VoteEnd.changePage(i);
            })
        }

        this.pagesBar[0].appendChild(ul);
    },

    /**
     * @Private - accessed from changePage()
     * */
    __hidePage: function () {
        $(this.text).stop().animate({ top: VoteEnd.initialTextMargin-100, opacity: 0 }, 700, "easeInOutQuint");

        $(this.hero).stop().animate({ marginTop: -10, opacity: 0 }, 700, "easeInOutQuint");
    },

    /**
     * @Private - accessed from changePage()
     * */
    __showPage: function () {
        $(this.text).animate({ opacity: 1 }, 700).dequeue();
        $(this.text).animate({ top: VoteEnd.initialTextMargin }, 700, "easeInOutQuint");

        var h = parseInt($(this.hero).css('height'));

        $(this.hero).animate({ opacity: 1 }, 1000).dequeue();
        $(this.hero).animate({ marginTop: (h/2)*-1 }, 1000, "easeInOutQuint");

        // $(this.form).fadeIn();
    },

    /**
     * @Private - accessed from changePage()
     * */
    __setPage: function (objectId)
    {
        var obj = Pages[objectId];
        console.log(obj);
        var paragraphs = obj.text.split('|');

        var container = document.getElementById('publicInfo');
        container.innerHTML = '';

        for(var idx in obj.db.finalists)
        {
            if (obj.db.finalists.hasOwnProperty(idx))
            {
                var finalista = obj.db.finalists[idx];
                // console.log(finalista);
                var div = document.createElement('div');
                div.innerHTML = finalista.name;
                container.appendChild(div);
            }
        }
        // if (obj.db.nominated) {
        //
        //     this.inputs[0].value = obj.db.nominated.name;
        //     this.inputs[1].value = obj.db.nominated.reference;
        //
        //     this.setAsBlocked(obj.db.id, obj);
        // }
        // else{
        //     this.inputs[0].value = 'Indicado';
        //     this.inputs[1].value = 'Referência';
        //
        //     this.setAsEnabled();
        // }

        VoteEnd.__setTitleAndColors(paragraphs, obj);

        var prev = document.getElementById('btn-previous');
        var next = document.getElementById('btn-next');

        prev.disble = false;
        prev.classList.remove("disabled");

        next.disble = false;
        next.classList.remove("disabled");

        if(VoteEnd.currentPage == 0){
            prev.disble = true;
            prev.classList.add("disabled");
        }

        if(VoteEnd.currentPage >= Script.length(Pages) -1){
            next.disble = true;
            next.classList.add("disabled");
        }
    },

    /*
     * Método também é usado em Voting.js para alterar a tela identicamente a ELEIÇÃO
     * */
    __setTitleAndColors: function (paragraphs, obj)
    {
        //Inserir o texto do titulo em sequencia das divs
        var i = 0;
        while (i < 3){
            var pItem = VoteEnd.text.find('> div')[i];

            var str = ( paragraphs[i] ) ? paragraphs[i] : '';
            $(pItem).html(str);

            i++;
        }

        Script.main.setAttribute('class', obj.colorClass);
        //Alterar as cores de bordas e etc.
        // this.form.removeAttr('class');
        // this.form.addClass(obj.formClass);
        this.logo.css("background-image","url(/site/media/images/"+obj.logo+")");

        // obj.styleHero = ( obj.styleHero ) ? obj.styleHero : false;

        this.hero.removeAttr('style');
        if (obj.styleHero) {
            this.hero.css(obj.styleHero);
        }

        this.hero.css("background-image","url(/site/media/images/"+obj.icon+")");

        this.main.css("background-color", obj.bgColor);
        this.main.css("borderColor", obj.mainBorderColor);

        //Set requirements
        // if (this.reqUL)
        // {
        //     this.reqUL.innerHTML = '';
        //     for(var idx in obj.requireds)
        //     {
        //         if (obj.requireds.hasOwnProperty(idx))
        //         {
        //             var req = obj.requireds[idx];
        //             var li      = document.createElement('li');
        //             var span    = document.createElement('span');
        //             li.appendChild(span);
        //
        //             span.innerHTML = req;
        //             this.reqUL.appendChild(li);
        //         }
        //     }
        // }

        // this.mobileReq();
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
            VoteEnd.showMask(main, masker, nw, speed, maxLeft)
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
    }
};