<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!--        <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                    </div>
                    <div class="pull-left info">
                        <p>Alexander Pierce</p>
        
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
        
                 search form 
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                      <span class="input-group-btn">
                        <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                      </span>
                    </div>
                </form>-->
        <!-- /.search form -->

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                        ['label' => 'แดชบอร์ด', 'icon' => 'home', 'url' => ['/site']],
                        ['label' => 'หนังสือแจ้งทราบ', 'icon' => 'comments', 'url' => ['/judgement']],
//                    ['label' => 'Event', 'icon' => 'dashboard', 'url' => ['/event']],
                        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        [
                            'label' => 'จัดการข้อมูล',
                            'icon' => 'cloud',
                            'url' => '#',
                            'items' => [
                                ['label' => 'หนังสือแจ้งทราบ', 'icon' => 'comments', 'url' => ['/judgement/index_admin'],],
                                ['label' => 'ปฏิทินงาน', 'icon' => 'calendar', 'url' => ['/event'],],
                                ['label' => 'ข้อมูลผู้ใช้','icon' => 'users','url' => ['/profile'],
                                    'items' => [
                                        ['label' => 'Profile', 'icon' => 'wrench', 'url' => ['/profile/index'],],
                                        ['label' => 'ผู้ใช้งานทั้งหมด', 'icon' => 'wrench', 'url' => ['/profile/index_admin'],],  
                                        ['label' => 'ตั้งค่าตำแหน่ง', 'icon' => 'wrench', 'url' => ['/profile/indexdep'],]
                                    ]],
                            ],
                        ],
                        [
                            'label' => 'ตั้งค่าโปรแกรม',
                            'icon' => 'wrench',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'หนังสือแจ้งทราบ',
                                    'icon' => 'wrench',
                                    'url' => ['/gii'],
                                    'items' => [
                                        ['label' => 'เพิ่ม/แก้ไขประเภทเอกสาร', 'icon' => 'wrench', 'url' => ['/typedoc/index'],],
                                        
                                    ],
                                ],
                                
                                [
                                    'label' => 'Yii2',
                                    'icon' => 'circle-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                                        ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                                        [
                                            'label' => 'Level Two',
                                            'icon' => 'circle-o',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                                ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
        )
        ?>

    </section>

</aside>
