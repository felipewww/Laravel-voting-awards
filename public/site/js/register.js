$(document).ready(function () {
    Register.init();
});

Register = {
    logo: null,
    text: null,
    actions: null,

    init: function () {
        // alert('here');
        this.logo = $('#logo');
        this.text = $('#text');
        this.actions = $('#actions');
        this.form = $('form[name="reg"]');

        $(this.logo).css('opacity', 0);
        $(this.text).css('opacity', 0);
        $(this.actions).css('opacity', 0);
        $(this.form).css('opacity', 0);

        Script.__intro();

        setTimeout(function () {

            var margin = parseInt( Register.logo.css('marginTop') );
            Register.logo.css('marginTop', margin-150);

            Register.logo.animate({ opacity: 1 }, 1000, "easeInOutQuint").dequeue();
            Register.logo.animate({ marginTop: margin }, 900, "easeInOutQuint");

            setTimeout(function () {
                Register.text.animate({ opacity: 1 }, 900, "easeInOutQuint");
            },600);

            margin = parseInt( Register.actions.css('marginTop') );
            Register.actions.css('marginTop', margin+150);

            setTimeout(function () {
                Register.actions.animate({ opacity: 1 }, 1000, "easeInOutQuint").dequeue();
                Register.form.animate({ opacity: 1 }, 1000, "easeInOutQuint").dequeue();
                Register.actions.animate({ marginTop: margin }, 900, "easeInOutQuint");
            }, 1000);

            // $(this.logo).fade;
            $(this.logo).fadeIn();
            $(this.text).fadeIn();
            $(this.actions).fadeIn();
            $(this.form).fadeIn();
        }, 1000);
    },

    submit: function ()
    {
        Script.loader('show')

        setTimeout(function () {
            document.forms.reg.submit();
        }, 300);
    }
};