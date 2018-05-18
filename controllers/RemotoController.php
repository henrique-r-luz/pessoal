<?php

namespace app\controllers;


use yii\web\Controller;
use JonnyW\PhantomJs\Client;

//require_once('vendor/autoload.php');

class RemotoController extends Controller {

    public function actionIndex() {

        return $this->render('index ');
    }
    
    
    public function actionExecutaPhantom(){
        $output = shell_exec(' phantomjs  /vagrant/pessoal/web/js/remoto.js');
        $rendaFixa =explode('!@', $output);
        foreach ($rendaFixa as $i=>$titulo){
            $linha = explode('#&', $titulo);
            $rendaFixa[$i]= $linha;        
        }
        unset($rendaFixa[0]);
        print_r($rendaFixa);
    } 

    public function actionCrawler() {

        $urlBase = 'https://portal.easynvest.com.br';
        $client = Client::getInstance();
        $client->getEngine()->addOption('--ssl-protocol=any');
        $client->getEngine()->addOption('--ignore-ssl-errors=true');
        $client->getEngine()->addOption('--web-security=false');
        $client->getEngine()->setPath('/usr/bin/phantomjs');
        $request = $client->getMessageFactory()->createRequest();
        $response = $client->getMessageFactory()->createResponse();
        $data = array(
            'AssinaturaEletronica'=>'',
            'Conta'=>'',
            'PrimeiroAcesso'=>	'false',
        );
        $request->setMethod('POST');
        $request->setUrl($urlBase.'/autenticacao/login');
        $request->setRequestData($data);
        $client->send($request, $response);
        
         //$request->setMethod('GET');
         //$request->setUrl($urlBase.'/financas/custodia/');

         // $client->send($request, $response);
          //if ($response->getStatus() === 200) {
          echo "<base href='" . $urlBase . "'>";
          echo $response->getContent(); 

        
        

        /* $urlBase = 'http://portal.easynvest.com.br/';
          $client = Client::getInstance();
          $client->getEngine()->addOption('--ssl-protocol=any');
          $client->getEngine()->addOption('--ignore-ssl-errors=true');
          $client->getEngine()->addOption('--web-security=false');
          $client->getEngine()->setPath('/usr/bin/phantomjs');
          $request = $client->getMessageFactory()->createRequest();
          $response = $client->getMessageFactory()->createResponse();

          $request->setMethod('GET');
          $request->setUrl($urlBase);

          $client->send($request, $response);
          //if ($response->getStatus() === 200) {
          echo "<base href='" . $urlBase . "'>";
          echo $response->getContent(); */

        //}
    }

}
