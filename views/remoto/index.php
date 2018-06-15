<?php


use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
//$this->registerJs('obtem-dados.js')

?>


<?= Html::a('get page', ['/remoto/executa-phantom'], ['class'=>'btn btn-primary']) ?>
