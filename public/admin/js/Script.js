$(document).ready(function () {
    Script.init();
    $('.has-tooltip').tooltip();
});

Script = {
    init: function () {
        console.log(window.csrfToken);
        this._token = window.csrfToken;
    },

    /*
    * Chamado via BACKEND em data-jslistener - UserController Datatables
    * */
    _alterStatus: function (event, element, params, window)
    {
        var id = element.getAttribute('data-voteid');
        var alterTo = element.getAttribute('data-alterto');
        var data = { vote: id, to: alterTo, _token: Script._token };

        if (parseInt(alterTo) == 1)
        {
            $.ajax({
                url: '/panel/alter/vote',
                method: 'post',
                data: data,
                dataType: 'json',
                success: function (data) {
                    console.log(element);
                    if (data.status) {
                        finish(element, alterTo);
                        swal(
                            'Tudo certo!',
                            'Voto aprovado com sucesso',
                            'success'
                        )

                    }else{
                        swal(
                            'Algo deu errado',
                            'Entre em contato com o administrador do sistema',
                            'error'
                        )
                    }
                },
                error: function (error) {
                    swal(
                        'Erro inesperado',
                        'Entre em contato com o administrador do sistema',
                        'error'
                    )
                }
            })
        }
        else if(alterTo == 2)
        {
            swal({
                title: 'Informe o motivo do cancelamento do voto.',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                showLoaderOnConfirm: true,
                preConfirm: function (motivo) {
                    return new Promise(function (resolve, reject) {

                        if (motivo == '') {
                            return reject('Motivo obrigatório');
                        }

                        if (motivo.length < 5 || motivo.length > 255) {
                            return reject('O motivo deve ter entre 5 e 255 caracteres.');
                        }

                        data.motivo = motivo;

                        setTimeout(function() {
                            $.ajax({
                                url: '/panel/alter/vote',
                                method: 'post',
                                data: data,
                                dataType: 'json',
                                success: function (data) {
                                    // console.log(element);
                                    if (data.status) {
                                        finish(element, alterTo);
                                        resolve();
                                    }else{
                                        reject('Não foi possível anular. Entre em contato com o administrador do sistema');
                                    }
                                },
                                error: function (error) {
                                    swal(
                                        'Erro inesperado',
                                        'Entre em contato com o administrador do sistema',
                                        'error'
                                    )
                                }
                            })

                        }, 1000)
                    })
                },
                allowOutsideClick: false
            }).then(function (email, a, b) {
                console.log("Response or email?", email);
                console.log(a);
                console.log(b);
                swal({
                    type: 'success',
                    title: 'Voto reprovado',
                })
            })
        }else{
            swal(
                'Erro inesperado',
                'Entre em contato com o administrador do sistema',
                'error'
            )
        }
        
        function finish(element, alterTo)
        {
            var keeptr = element.getAttribute('data-keep');
            var parentTR = $(element).closest('tr').first();

            if (!keeptr) {
                $(parentTR).remove();
            }else{
                var statusTD = $(parentTR).find('td')[keeptr];
                var newStatus = (alterTo == 1) ? 'Válido' : 'Cancelado';
                $(statusTD).html(newStatus);
            }
        }
    }
};