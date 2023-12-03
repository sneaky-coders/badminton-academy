<!-- views/booking/print-bill.php -->

<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Print Bill';
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-print-bill">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'transactionid',
            'orderid',
            'amount',
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
                        default:
                            return Html::encode($model->status);
                    }
                },
                'format' => 'raw',
            ],
            // Add more attributes as needed
        ],
    ]) ?>

    <!-- Add additional content or formatting for printing -->
</div>
