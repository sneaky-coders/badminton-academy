<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Court */

$this->title = 'Create Court';
$this->params['breadcrumbs'][] = ['label' => 'Courts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="court-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
