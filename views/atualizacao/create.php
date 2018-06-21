<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Atualizacao */

$this->title = 'Create Atualizacao';
$this->params['breadcrumbs'][] = ['label' => 'Atualizacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atualizacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
