<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Titulos */

$this->title = 'Create Titulos';
$this->params['breadcrumbs'][] = ['label' => 'Titulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titulos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
