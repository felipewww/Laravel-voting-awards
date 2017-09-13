$(document).ready(function () {
    Login.init();
});

Login = {
    FB_APP_ID: null, //from backend
    logo: null,
    text: null,
    actions: null,

    init: function () {
        // alert('here');
        this.logo = $('#logo');
        this.text = $('#text');
        this.actions = $('#actions');

        $(this.logo).css('opacity', 0);
        $(this.text).css('opacity', 0);
        $(this.actions).css('opacity', 0);

        Script.__intro();

        setTimeout(function () {

            var margin = parseInt( Login.logo.css('marginTop') );
            Login.logo.css('marginTop', margin-150);

            Login.logo.animate({ opacity: 1 }, 1000, "easeInOutQuint").dequeue();
            Login.logo.animate({ marginTop: margin }, 900, "easeInOutQuint");

            setTimeout(function () {
                Login.text.animate({ opacity: 1 }, 900, "easeInOutQuint");
            },600);

            margin = parseInt( Login.actions.css('marginTop') );
            Login.actions.css('marginTop', margin+150);

            setTimeout(function () {
                Login.actions.animate({ opacity: 1 }, 1000, "easeInOutQuint").dequeue();
                Login.actions.animate({ marginTop: margin }, 900, "easeInOutQuint");
            }, 1000);
            // this.text.fadeIn(600);

            // $(this.logo).fade;
            $(this.logo).fadeIn();
            $(this.text).fadeIn();
            $(this.actions).fadeIn();
        }, 1000);


    },

    fbLogin: function () {

        Script.loader('show');

        FB.login(function (response) {
// console.log('response is::', response);
// return;
            if (!response.authResponse) {
                Script.loader('hide');
                console.log('canceled');
                return;
            }
            __token = response.authResponse.accessToken;


            if (response.status == 'connected')
            {
                FB.api('/me?fields=email,name,link', function(response) {

                    if (!response.email || response.email == '') {
                        response.email = 'sem email'
                    }

                    if (!response.name || response.name == '') {
                        response.name = 'sem nome'
                    }

                    $.ajax({
                        url: '/login',
                        method: 'post',
                        data: { _token: window.csrfToken, user: response, from: 'fb', __token: __token }, //ok
                        dataType: 'json',
                        success: function (data) {
                            if (data.status) {
                                window.location.href = '/indicacao';
                            }
                        },
                        error: function (error) {
                            console.log('Tente novamente');
                        },
                        complete: function (response) {
                            console.log('Compelte Response', response);
                            setTimeout(function () {
                                Script.loader('hide');
                                if (!response.responseJSON.status) {
                                    Script._modal('Não foi possível fazer login. Entre em contato conosco');
                                }
                            }, 1300);
                        }
                    });
                });
            }
            else
            {
                Script.loader('hide');
                alert('Ops, algo deu errado com o login. tente novamente');
            }

        }, { scope: 'public_profile,email', enable_profile_selector: true });
    }
};