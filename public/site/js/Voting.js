$(document).ready(function () {
    Voting.init();
});

Voting = {

    container: null,
    selectedID: null,

    init: function ()
    {
        this.container =  document.getElementById('finalists');
    },

    findCategoryFinalistById: function (item, id) {
        for (var idx in item.db.finalists)
        {
            var f = item.db.finalists[idx];
            if (id == f.id){
                return f;
            }
        }
    },

    _gavetaName: function (indicado, item)
    {
        // console.log("INDICADO!", indicado);
        var parent = $(indicado).closest('li');
        // console.log("INDICADO!", parent);
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
        // console.log(obj);
        var voted = this.findCategoryFinalistById(obj, obj.db.voted);

        var liID = 'cat_'+catid;
        var li = $(Ellection.ulGaveta).find('li[id="'+liID+'"]').first();
        $(li).find('.indicado').first().html(voted.name);

        var btn = $(li[0]).find('.button')[0];
        $(btn).find('._link').first().find('div').first().html('VER');

        Ellection.mainBtn.addClass('voted');
        Ellection.mainBtn[0].onclick = function () {
            // Voting.send();
            Script._modal('Você ja votou nessa categoria');
        }
    },

    setAsEnabled: function ()
    {
        Ellection.mainBtn.removeClass('voted');
        Ellection.mainBtn[0].onclick = function () {
            Voting.send();
        }
    },

    send: function () {
        var obj = Pages[Ellection.currentPage];
        if (!this.selectedID) {
            Script._modal('Selecione um indicado');
            return;
        }

        var _this = this;
        var data = { _token: window.csrfToken, id: this.selectedID };

        $.ajax({
            url: '/indicacao/vote',
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
    
    __setPage: function (objectId) {
        this.selectedID = null;
        $('.voted').removeClass('voted');

        var obj = Pages[objectId];

        var paragraphs = obj.text.split('|');

        if (!obj.db.voted) {
            // console.log('setting as enabled...');
            Voting.setAsEnabled();
        }

        $(this.container).find('.finalist').each(function (idx) {
            var finalistInfo = obj.db.finalists[idx];
            var divName = $(this).find('.name').first();

            $(this)[0].onclick = function () {
                if (!obj.db.voted) {
                    $('.voted').removeClass('voted');
                    $(this).addClass('voted');
                }
                Voting.selectedID = finalistInfo.id;
            };

            if (obj.db.voted == finalistInfo.id) {
                // console.log('setting as BLOCKED...');
                Voting.setAsBlocked(obj.db.id, obj);
                $(this).addClass('voted');
            }

            divName.html(finalistInfo.name);

        });

        Ellection.__setTitleAndColors(paragraphs, obj);
    }
};