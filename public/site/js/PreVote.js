$(document).ready(function () {
    Voting.init();
});

Voting = {

    container: null,
    selectedID: null,

    init: function ()
    {
        this.container =  document.getElementById('pre_finalists');
    },

    findCategoryFinalistById: function (item, id)
    {

    },

    _gavetaName: function (indicado, item)
    {

    },

    _gavetaButtonText: function (item) {

    },

    setAsBlocked: function (catid, obj)
    {

    },

    setAsEnabled: function ()
    {

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
    
    __setPage: function (objectId)
    {

    }
};