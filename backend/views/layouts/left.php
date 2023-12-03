<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
                <p></p>
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?php
        if (!Yii::$app->user->isGuest) {

            echo dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree'],
                    'items' => [
                        ['label' => 'Dashboard', 'icon' => 'circle-o', 'url' => ['/site/index'],],
                    ],
                ]
            );


            echo dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    'items' => [
                        [
                            'label' => 'Bookings',
                            'icon' => 'money',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Bookings', 'icon' => 'circle-o', 'url' => ['/booking/index'],],
                                ['label' => 'Customer Details', 'icon' => 'circle-o', 'url' => ['/court/index'],],




                            ],
                        ],
                    ],
                ]
            );

            

        }


            // Navbar links for Admin
        

        ?>

    </section>

</aside>