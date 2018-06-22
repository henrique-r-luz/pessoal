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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Atualiza Dados', ['executa-phantom'], ['class'=>'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            'id',
            'data',
            'valor_total',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
