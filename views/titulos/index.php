<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TitulosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Titulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titulos-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    

    <p>
        <?= Html::a('Create Titulos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
       'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
       
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => $this->title,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ativo:ntext',
            'emissor:ntext',
            'quantidade',
            'tributos',
            //'valor_compra',
            //'valor_venda',
            //'atualizacao_id',
            //'categoria_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
