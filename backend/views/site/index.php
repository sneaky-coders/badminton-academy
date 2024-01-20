<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
use app\models\Booking;


// Fetching total amounts
$Amount = Booking::find()->sum('amount');
$Amount1 = Booking::find()->count('transactionid');
$Amount2 = Booking::find()->where(['status' => 'paid'])->count('transactionid');

// Fetching accenture data (replace 'YourModel' with the actual model name)
$accentureData = Booking::find()->select(['transactionid', 'amount'])->asArray()->all();

$accentureLabels = array_column($accentureData, 'transactionid'); // Change 'usn' to 'transactionid'
$accentureScores = array_column($accentureData, 'amount'); // Change 'total' to 'amount'
$accentureLabelsJson = json_encode($accentureLabels);
$accentureScoresJson = json_encode($accentureScores);

$js = <<< JS
var ctxAccenture = document.getElementById('accentureGraph').getContext('2d');
var accentureChart = new Chart(ctxAccenture, {
    type: 'bar',
    data: {
        labels: $accentureLabelsJson,
        datasets: [{
            label: 'Transactions',
            data: $accentureScoresJson,
            backgroundColor: 'rgba(255, 99, 132, 0.7)',
            borderColor: 'rgba(255, 255, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
JS;

$this->registerJs($js);
?>

<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <?php
        echo \insolita\wgadminlte\LteSmallBox::widget([
            'type' => \insolita\wgadminlte\LteConst::COLOR_YELLOW,
            'title' => '₹' . number_format($Amount, 2),
            'text' => 'Revenue',
            'icon' => 'fa fa-book',
            'footer' => 'More info</i>',
            'link' => \yii\helpers\Url::to("#")
        ]);
        ?>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <?php
        echo \insolita\wgadminlte\LteSmallBox::widget([
            'type' => \insolita\wgadminlte\LteConst::COLOR_LIGHT_BLUE,
            'title' => $Amount1,
            'text' => 'Total Transactions',
            'icon' => 'fa fa-users',
            'footer' => 'More info</i>',
            'link' => \yii\helpers\Url::to("#")
        ]);
        ?>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <?php
        echo \insolita\wgadminlte\LteSmallBox::widget([
            'type' => \insolita\wgadminlte\LteConst::COLOR_MAROON,
            'title' =>  $Amount2,
            'text' => 'Status Paid',
            'icon' => 'fa fa-user',
            'footer' => 'More info</i>',
            'link' => \yii\helpers\Url::to("#")
        ]);
        ?>
    </div>

    <div class="col-md-6">
        <div class="graph-container">
            <canvas id="accentureGraph"></canvas>
        </div>
    </div>
</div>
