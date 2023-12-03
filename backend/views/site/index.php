<div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <?php
                if (Yii::$app->user->identity->level == 1 || Yii::$app->user->identity->level == 2) {
                    echo \insolita\wgadminlte\LteSmallBox::widget([
                        'type' => \insolita\wgadminlte\LteConst::COLOR_YELLOW,
                        'title' => 2,
                        'text' => 'Full Stack Enrolled',
                        'icon' => 'fa fa-book',
                        'footer' => 'More info</i>',
                        'link' => \yii\helpers\Url::to("#")
                    ]);
                } else {
                }
                ?>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <?php
                if (Yii::$app->user->identity->level == 1 || Yii::$app->user->identity->level == 2) {
                    echo \insolita\wgadminlte\LteSmallBox::widget([
                        'type' => \insolita\wgadminlte\LteConst::COLOR_LIGHT_BLUE,
                        'title' =>  2,
                        'text' => 'Internet Of Things Enrolled',
                        'icon' => 'fa fa-users',
                        'footer' => 'More info</i>',
                        'link' => \yii\helpers\Url::to("#")
                    ]);
                } else {
                }
                ?>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <?php
                if (Yii::$app->user->identity->level == 1 || Yii::$app->user->identity->level == 2) {
                    echo \insolita\wgadminlte\LteSmallBox::widget([
                        'type' => \insolita\wgadminlte\LteConst::COLOR_MAROON,
                        'title' => 2,
                        'text' => 'Django Enrolled',
                        'icon' => 'fa fa-user',
                        'footer' => 'More info</i>',
                        'link' => \yii\helpers\Url::to("#")
                    ]);
                } else {
                }
                ?>
            </div>
        










        </div>