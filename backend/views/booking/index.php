<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchBooking */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Booking', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            if ($model->status == 'paid') {
                return ['class' => 'success'];
            }
            else
            {
                return ['class' => 'warning'];
            }
            // Add more conditions for other statuses if needed
            return [];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
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
                    return $model->court->contact;
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
                            return '<span class="label label-warning">Pending</span>';
                        case 'paid':
                            return '<span class="label label-success">Paid</span>';
                        case 'canceled':
                            return '<span class="label label-danger">Canceled</span>';
                        case 'refunded':
                            return '<span class="label label-info">Refunded</span>';
                        default:
                            return Html::encode($model->status);
                    }
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
