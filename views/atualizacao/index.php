<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtualizacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atualizacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atualizacao-index">
    <p>
        <?= Html::a('Atualiza Dados', ['executa-phantom'], ['class' => 'btn btn-primary']) ?>
    </p>

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
            'id',
            'data',
            'valor_total',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
