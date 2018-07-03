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


  

    <?=
    GridView::widget([
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
            [
              'attribute'=>'ativo',
                'pageSummary'=>'Total',
            ],
            'emissor:ntext',
            'quantidade',
            'tributos',
            'taxa',
            [
                'attribute' => 'valor_compra',
                'pageSummary' => true,
            ],
             [
                'attribute' => 'valor_venda',
                'pageSummary' => true,
            ],
            [
                'attribute' => 'Lucro',
                'format' => 'raw',
                'value' => function ($model) {
                    return number_format($model->valor_venda - $model->valor_compra, 2, '.', ',');
                },
                'pageSummary' => true,
            ],
            //'atualizacao_id',
            //'categoria_id',
            ['class' => 'kartik\grid\ActionColumn'],
        ],
        'showPageSummary' => true,
        'showFooter' => true

    ]);
    ?>
</div>
