<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categorias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorias-form">

    <?php $form = ActiveForm::begin(); ?>
     
     
    <div>
		<div class="col-xs-12 col-lg-12 no-padding">
    <?= $form->field($model, 'id')->input([]) ?> 
    </div>
		<div class="col-xs-12 col-lg-12 no-padding">
        <?= $form->field($model, 'nome')->input([]) ?>
     </div>
		<div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
		<div>
    <?php ActiveForm::end(); ?>

</div>