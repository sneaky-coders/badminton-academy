<?php

use app\models\DepartureDetailCoTraveller;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DepartureDetail */

$this->title = "Bookings";
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);



?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="departure-detail-view">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-6 text-right">

        </div>
    </div>
    <br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Name',
                'attribute' => 'court_id',
                'value' => function ($model) {
                    return $model->court->name;
                },
            ],
            [
                'label' => 'Email',
                'attribute' => 'court_id',
                'value' => function ($model) {
                    return $model->court->email;
                },
            ],
            [
                'label' => 'Phone',
                'attribute' => 'court_id',
                'value' => function ($model) {
                    return '+91'.$model->court->contact;
                },
            ],
            [
                'label' => 'Booking Date',
                'attribute' => 'court_id',
                'value' => function ($model) {
                    return $model->court->date;
                },
            ],
            [
                'label' => 'Booking Start Time',
                'attribute' => 'court_id',
                'value' => function ($model) {
                    return $model->court->starttime;
                },
            ],
            [
                'label' => 'Booking End Time',
                'attribute' => 'court_id',
                'value' => function ($model) {
                    return $model->court->endtime;
                },
            ],   
            [
                'label' => 'Adults',
                'attribute' => 'court_id',
                'value' => function ($model) {
                    return $model->court->adults;
                },
            ],
            [
                'label' => 'Children',
                'attribute' => 'court_id',
                'value' => function ($model) {
                    return $model->court->children;
                },
            ],
            [
                'label' => 'Kids',
                'attribute' => 'court_id',
                'value' => function ($model) {
                    return $model->court->young_children;
                },
            ],
            'transactionid',
            'orderid',
            [
                'label' => 'Amount',
                'attribute' => 'amount',
                'value' => function ($model) {
                    return Yii::$app->formatter->asCurrency($model->amount, 'INR');
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    switch ($model->status) {
                        case 'pending':
                            return '<b>Pending</b>';
                        case 'paid':
                            return '<b>Paid</b>';
                        case 'canceled':
                            return '<b>Canceled</b>';
                        case 'refunded':
                            return '<b>Refunded</b>';
                        default:
                            return Html::encode($model->status);
                    }
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

  

    

    <br>
</div>