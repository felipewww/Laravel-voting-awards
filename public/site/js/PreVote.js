$(document).ready(function () {
    PreVote.init();
});

PreVote = {

    container: null,
    selectedID: null,
    Select: null,
    OptionSelected: null,

    init: function ()
    {
        this.container =  document.getElementById('pre_finalists');
        this.Select = document.getElementById('prefinalists');

        this.Select.onchange = function () {
            PreVote.OptionSelected = this.selectedOptions[0].value;
        };
    },

    findCategoryFinalistById: function (item, id)
    {
        for (var idx in item.db.prefinalists)
        {
            var f = item.db.prefinalists[idx];
            if (id == f.id){
                return f;
            }
        }

        return 'not found';
    },

    _gavetaName: function (indicado, item)
    {
        var parent = $(indicado).closest('li');
        var votedHTML = 'Não encontrado';

        if (item.db.voted) {
            var voted = this.findCategoryFinalistById(item, item.db.voted);
            votedHTML = voted.name;

        }else{
            votedHTML = "Não votado";
        }

        indicado.innerHTML = votedHTML;
    },

    _gavetaButtonText: function (item) {
        return  (item.db.voted) ? 'VER' : 'INDICAR';
    },

    setAsBlocked: function (catid, obj)
    {
        this.Select.disabled = 'disabled';

        var voted = this.findCategoryFinalistById(obj, obj.db.voted);
        var liID = 'cat_'+catid;
        var li = $(Ellection.ulGaveta).find('li[id="'+liID+'"]').first();
        $(li).find('.indicado').first().html(voted.name);

        var btn = $(li[0]).find('.button')[0];
        $(btn).find('._link').first().find('div').first().html('VER');

        Ellection.mainBtn.addClass('voted');
        Ellection.mainBtn[0].onclick = function () {
            Script._modal('Você ja votou nessa categoria.');
        }
    },

    setAsEnabled: function ()
    {
        this.Select.removeAttribute('disabled');
        Ellection.mainBtn.removeClass('voted');
        Ellection.mainBtn[0].onclick = function () {
            PreVote.send();
        }
    },

    send: function () {
        var obj = Pages[Ellection.currentPage];

        if (!this.OptionSelected) {
            Script._modal('Selecione um indicado');
            return;
        }

        var _this = this;
        var data = { cat_id: this.selectedID, f_id: this.OptionSelected };

        $.ajax({
            url: '/indicacao/prevote',
            data: data,
            method: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    Script._modal('Voto computado com sucesso!');
                    obj.db.voted = data.voted_id;
                    _this.setAsBlocked(obj.db.id, obj);
                }else{
                    Script._modal(data.message);
                    setTimeout(function () {
                        window.location.href="/";
                    }, 400);
                }
            },
            error: function () {
                Script._modal('Erro inesperado. Tente novamente.');
                setTimeout(function () {
                    window.location.href="/";
                }, 400);
            }
        })
    },
    
    __setPage: function (objectId)
    {
        $('.voted').removeClass('voted');

        var obj = Pages[objectId];

        this.selectedID = obj.db.id;
        this.OptionSelected = null;

        var paragraphs = obj.text.split('|');

        if (!obj.db.voted) {
            PreVote.setAsEnabled();
        }

        this.Select.innerHTML = '';
        this.Select.removeAttribute('disabled');

        var opt = document.createElement('option');
        opt.innerHTML = 'Selecione um Pré Finalista';
        this.Select.appendChild(opt);

        for(var idx in obj.db.prefinalists)
        {
            var DB = obj.db.prefinalists;
            if (DB.hasOwnProperty(idx))
            {
                var info = DB[idx];
                opt = document.createElement('option');
                opt.value = info.id;
                opt.innerHTML = info.name;

                if (obj.db.voted && info.id == obj.db.voted) {
                    this.setAsBlocked(obj.db.id, obj);
                    opt.selected = 'selected';
                    this.Select.disabled = 'disabled';
                }

                this.Select.appendChild(opt);

            }
        }

        $(this.container).find('.finalist').each(function (idx) {
            var finalistInfo = obj.db.finalists[idx];
            var divName = $(this).find('.name').first();

            $(this)[0].onclick = function () {
                if (!obj.db.voted) {
                    $('.voted').removeClass('voted');
                    $(this).addClass('voted');
                }
                //Voting.selectedID = finalistInfo.id;
            };

            if (obj.db.voted == finalistInfo.id) {
                // console.log('setting as BLOCKED...');
                PreVote.setAsBlocked(obj.db.id, obj);
                $(this).addClass('voted');
            }

            divName.html(finalistInfo.name);

        });

        Ellection.__setTitleAndColors(paragraphs, obj);
    }
};