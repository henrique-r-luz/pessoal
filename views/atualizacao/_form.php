<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Atualizacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atualizacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'valor_total')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
