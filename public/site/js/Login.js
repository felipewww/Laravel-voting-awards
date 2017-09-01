$(document).ready(function () {
    Login.init();
});

Login = {
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
    }
};