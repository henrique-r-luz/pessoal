<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Titulos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="titulos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ativo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'emissor')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'tributos')->textInput() ?>

    <?= $form->field($model, 'valor_compra')->textInput() ?>

    <?= $form->field($model, 'valor_venda')->textInput() ?>

    <?= $form->field($model, 'atualizacao_id')->textInput() ?>

    <?= $form->field($model, 'categoria_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
