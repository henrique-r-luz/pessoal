//robo de acesso ao site da easynvest
//var system = require('system');

//var login = system.args[1];
//var senha = system.args[2];
var page = require('webpage').create(),
        //acessa o site 
        server = 'https://portal.easynvest.com.br/autenticacao/login',
        //define os parâmetros de autenticação
        //data = 'AssinaturaEletronica='+senha+'&Conta='+login+'&PrimeiroAcesso=false';
        data = 'AssinaturaEletronica='+'N1yC9t'+'&Conta='+'5224629'+'&PrimeiroAcesso=false';
        
//realiza a requisição post
page.open(server, 'post', data, function (status) {
    if (status !== 'success') {
        console.log('Unable to post!'+status);
        phantom.exit();    
    } else {  
    	//após a requisição acessa o site de custodia 
        page.open('https://portal.easynvest.com.br/financas/custodia/', function (status) { 
            if (status === "success") {
            	// define um time out para dar tempo da pagina carregar
                setTimeout(function () {
                	//inporta a biblioteca java script
                    page.includeJs("http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js", function () {
                        //obtém os titulos de renda fixa
                        console.log(page.evaluate(function () {
                            var text = '';
                            $("#div_rendafixa > table > tbody > tr").each(function() {
                                   text=text+'!@';
                                   $(this).find('td').each(function(){
                                       text=text+$(this).html()+'#&';
                                })
                            });
                            return text;
                           
                        }));
                     phantom.exit();    
                    });
                }, 5000);
            } else {
                console.log('erro ao abrir custódia')
                phantom.exit();    
            }
        });
    }

});
