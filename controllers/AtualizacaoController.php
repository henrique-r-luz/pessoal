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
use app\componentes\Mesagens;
use app\componentes\Helper;

/**
 * AtualizacaoController implements the CRUD actions for Atualizacao model.
 */
class AtualizacaoController extends Controller {

    /**
     * @inheritdoc
     */
    private $erros = '';

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
        if (Atualizacao::find()->where(['data' => date('Y-m-d')])->exists()) {
            Yii::$app->getSession()->setFlash('warning', 'O procedimento já foi realizado neste data' );
            return $this->redirect(['index']);
        }
        $dados = $this->executaRobo();
        $resposta = $this->populaBanco($dados);
        if ($resposta == true) {
            Yii::$app->getSession()->setFlash('success', 'Os dados foram atualizacdos');
            return $this->redirect(['index']);
        }
        if ($resposta == false) {
            Yii::$app->getSession()->setFlash('error', 'Ocorreu um erro:' . $this->erros);
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
        //obtém os investimentos da easynveste
        $tipoIvestimentos = explode(']@[', $output);
        //renfa fixa
        $rendaFixa = explode('!@', $tipoIvestimentos[1]);
        foreach ($rendaFixa as $i => $titulo) {
            $linha = explode('#&', $titulo);
            $rendaFixa[$i] = $linha;
        }
        //fundos de investimentos
        $fundos = explode('!@', $tipoIvestimentos[2]);
        foreach ($fundos as $i => $titulo) {
            $linha = explode('#&', $titulo);
            $fundos[$i] = $linha;
        }
        print_r($rendaFixa);
        exit();
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

    /*
     * popula o banco de dados com os valores recuperados pelo motor de busca
     */

    private function populaBanco($dados) {

        Categorias::popula();
        $transaction = Yii::$app->db->beginTransaction();
        try {

            $atualizacao = new Atualizacao();
            $atualizacao->data = date('Y-m-d');
            $atualizacao->valor_total = 0;
            if (!$atualizacao->save()) {
                $this->erros = 'Modelo Atualização ' . Mesagens::erros($atualizacao->getErrors());
                return false;
            }
            foreach ($dados as $titulo) {
                if (sizeof($titulo) != 1) {
                    $objTitulo = new Titulos();
                    $ativo = Helper::get_string_between($titulo[0], '">', '</');
                    $objTitulo->ativo = $ativo;
                    $objTitulo->emissor = $titulo[1];
                    //os valores de compra, venda e quantidade deve ser  convertidos
                    $compra = str_replace('.', '', $titulo[3]);
                    $compra = str_replace(',', '.', $compra);
                    $venda = str_replace('.', '', $titulo[7]);
                    $venda = str_replace(',', '.', $venda);
                    $quantidade = str_replace(',', '.', $titulo[2]);
                    $tributos = str_replace(',', '.', $titulo[6]);
                    $objTitulo->quantidade = $quantidade;
                    $objTitulo->taxa = $titulo[5];
                    $objTitulo->tributos = $tributos;
                    $objTitulo->valor_compra = $compra;
                    $objTitulo->valor_venda = $venda;
                    $objTitulo->atualizacao_id = $atualizacao->id;
                    $objTitulo->categoria_id = 1;
                    if (!$objTitulo->save()) {
                        $this->erros = ' Modelo Titulos ' . Mesagens::erros($objTitulo->getErrors());
                        return false;
                    }
                }
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        
    }

}
