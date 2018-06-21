<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TitulosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="titulos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ativo') ?>

    <?= $form->field($model, 'emissor') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?= $form->field($model, 'tributos') ?>

    <?php // echo $form->field($model, 'valor_compra') ?>

    <?php // echo $form->field($model, 'valor_venda') ?>

    <?php // echo $form->field($model, 'atualizacao_id') ?>

    <?php // echo $form->field($model, 'categoria_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
