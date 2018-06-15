
var login = '';
var senha = '';
var page = require('webpage').create(),
        server = 'https://portal.easynvest.com.br/autenticacao/login',
        data = 'AssinaturaEletronica='+senha+'&Conta='+login+'&PrimeiroAcesso=false';

page.open(server, 'post', data, function (status) {
    if (status !== 'success') {
        console.log('Unable to post!');
    } else {
        //console.log('post ok')
        //console.log(page.content);
        // page.render('easy.png');
        //var page = require('webpage').create(),
        //setTimeout(function () {
        page.open('https://portal.easynvest.com.br/financas/custodia/', function (status) {
            //console.log("Status: " + status);
            if (status === "success") {
                setTimeout(function () {
                    page.includeJs("http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js", function () {
                        //console.log('carrega fim...')
                        //page.render('custodia.png');
                        console.log(page.evaluate(function () {
                            var text = '';
                            $("#div_rendafixa > table > tbody > tr").each(function() {
                                   text=text+'!@';
                                   $(this).find('td').each(function(){
                                       //console.log($(this).find('a'))
                                       text=text+$(this).html()+'#&';
                                })
                            });
                            return text;
                           
                        }));
                     phantom.exit();    
                    });
                }, 5000);
            } else {
                //console.log('erro ao abrir custódia')
            }


        });
    }

});
