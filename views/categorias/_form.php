<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categorias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorias-form">

    <?php $form = ActiveForm::begin(); ?>
     
     <div class="row">
    <div class="col-xs-6 col-sm-2 col-lg-2">
    
    <?= $form->field($model, 'id')->textInput() ?> 
    </div>
    <div class="col-lg-10 col-md-10">
  
        <?= $form->field($model, 'nome')->textInput() ?>
    </div>
   </div>  
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

		
    <?php ActiveForm::end(); ?>

</div>