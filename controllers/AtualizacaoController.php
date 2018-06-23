<?php

namespace app\controllers;

use Yii;
use app\models\Atualizacao;
use app\models\AtualizacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Categorias;
use app\models\Titulos;

/**
 * AtualizacaoController implements the CRUD actions for Atualizacao model.
 */
class AtualizacaoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Atualizacao models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AtualizacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Atualizacao model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Atualizacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Atualizacao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Atualizacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Atualizacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    
      public function actionExecutaPhantom() {
        //recupera login e senha
        $dados = $this->executaRobo();
        $resposta = $this->populaBanco($dados);
        if($resposta==true){
             Yii::$app->getSession()->setFlash('success', 'Os dados foram atualizacdos');
             return $this->redirect(['index']); 
        }
        else{
             Yii::$app->getSession()->setFlash('error', 'Ocorreu um erro');
             return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Atualizacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Atualizacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Atualizacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

  

    private function executaRobo() {
        $xml = $this->getLoginSenha();
        $output = shell_exec('phantomjs  /vagrant/pessoal/web/js/remoto.js ' . $xml->login . ' ' . $xml->senha);
        $rendaFixa = explode('!@', $output);
        foreach ($rendaFixa as $i => $titulo) {
            $linha = explode('#&', $titulo);
            $rendaFixa[$i] = $linha;
        }

        return $rendaFixa;
    }

    private function getLoginSenha() {
        $url = '/vagrant/autentica.xml';
        if (file_exists($url)) {
            $xml = simplexml_load_file($url);
            return $xml;
        } else {
            exit('Falha ao abrir  XML.');
        }
    }

    private function populaBanco($dados) {
        
        $transaction = Yii::$app->db->beginTransaction();
        $atualizacao = new Atualizacao();
        $atualizacao->data = date('Y-m-d');
        $atualizacao->valor_total = 0;
        try {
            foreach ($dados as $titulo) {
                if (sizeof($titulo) != 1) {
                    $objTitulo = new Titulos();
                    $objTitulo->ativo = $titulo[0];
                    $objTitulo->emissor = $titulo[1];
                    $objTitulo->quantidade = $titulo[2];
                    //os valore sde compra e venda deve ser  convertidos
                    $objTitulo->valor_compra = $titulo[3];
                    $objTitulo->valor_venda = $titulo[7];
                    $objTitulo->atualizacao_id = $atualizacao->id;
                    $objTitulo->categoria_id = 1;
                    if (!$objTitulo->save()){
                        return false;
                    }
                        
                    
                       // echo 'erro: '.print_r($objTitulo->getErrors());
                       // exit();
                       // throw new NotFoundHttpException('Ocorreu um erro ao salvar os titulos.'.print_r($objTitulo->getErrors()));
                }
            }
            if (!$atualizacao->save()) {
                throw new NotFoundHttpException('Ocorreu um erro ao salvar a atualização.');
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        //renda fixa possui id = 1
        //titulos = Titulos::find()
    }

}
