<!-- views/booking/bill.php -->

<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Bill';
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="booking-bill">
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

    <?= Html::a('Print', ['print-bill', 'id' => $model->id], [
        'class' => 'btn btn-primary',
        'target' => '_blank', // Open in a new tab
        'onclick' => 'print();', // JavaScript function to trigger the print dialog
    ]) ?>

</div>
