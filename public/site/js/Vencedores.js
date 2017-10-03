$(document).ready(function () {
    Vencedores.init();
});

Vencedores = {
    init: function () {
        console.log(this.winners);
        this.generateHTML();
    },

    generateHTML: function ()
    {
        for(var idx in this.winners)
        {
            if (this.winners.hasOwnProperty(idx))
            {
                var winner = this.winners[idx];
                var div = document.createElement('div');
                div.setAttribute('class','winner');

                var name = document.createElement('div');
                name.setAttribute('class','name');
                name.innerHTML = winner.name;

                var cat = document.createElement('div');
                cat.setAttribute('class','cat');
                cat.innerHTML = Script.realCategorieName(winner.categorie.name);

                var share = document.createElement('div');
                share.setAttribute('class','share');
                share.onclick = function () {
                    Vencedores.__share(winner.categorie_id);
                }
            }
        }
    },

    __share: function (catid)
    {
        var displayMethod = (Script.isMobile()) ? 'iframe' : 'popup';

        alert("Compartilhar "+catid);
        // FB.ui({
        //     app_id: publicAppId,
        //     method: 'share',
        //     // mobile_iframe: mframe,
        //     mobile_iframe: true,
        //     cookie: true,
        //     xfbml: true,
        //     display: displayMethod,
        //     href: window.APP_URL+'/share/'+catid+'/'+shareToken,
        // }, function(response){});
    },
};