<?php

namespace app\controllers;


use yii\web\Controller;
use JonnyW\PhantomJs\Client;

//require_once('vendor/autoload.php');

class RemotoController extends Controller {

    public function actionIndex() {
         
        return $this->render('index');
    }
    
    
    public function actionExecutaPhantom(){
        $output = shell_exec('phantomjs  /vagrant/pessoal/web/js/remoto.js');
        $rendaFixa =explode('!@', $output);
        foreach ($rendaFixa as $i=>$titulo){
            $linha = explode('#&', $titulo);
            $rendaFixa[$i]= $linha;        
        }
        unset($rendaFixa[0]);
        print_r($rendaFixa);
    } 
    
    
    public function getLoginSenha(){
        $url = '/vagrant/autentica.xml';
        if (file_exists($url)) {
            $xml = simplexml_load_file($url);
            print_r($xml);
        } else {
            exit('Falha ao abrir  XML.');
        }
    }

   
}
