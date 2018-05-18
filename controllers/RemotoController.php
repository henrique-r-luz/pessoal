<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use JonnyW\PhantomJs\Client;

//require_once('vendor/autoload.php');

class RemotoController extends Controller {

    public function actionIndex() {

        return $this->render('index');
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
