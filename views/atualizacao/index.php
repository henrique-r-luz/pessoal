<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtualizacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atualizacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atualizacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Atualiza Dados', ['/remoto/executa-phantom'], ['class'=>'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data',
            'valor_total',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
