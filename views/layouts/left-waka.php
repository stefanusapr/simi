<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Wakil Kepala Sarpras</p>
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

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    'items' => [
                        ['label' => 'Inventaris Barang', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'fas fa-dashboard', 'url' => ['/site/index']],
                        ['label' => 'Master Barang', 'icon' => 'fas fa-table', 'url' => ['barang/index-waka']],
                        ['label' => 'Daftar Pengajuan', 'icon' => 'fas fa-edit', 'url' => ['/persetujuan/index']],
                        ['label' => 'Daftar Persetujuan', 'icon' => 'fas fa-check-square-o', 'url' => ['/persetujuan/index-riwayat']],
                        ['label' => 'Laporan', 'icon' => 'fas fa-file', 'url' => ['/#']],
                        ['label' => 'Pengaturan Akun', 'icon' => 'fas fa-user', 'url' => ['/site/akun']],
                        ['label' => 'Keluar', 'icon' => 'fas fa-sign-out-alt', 'url' => ['site/logout'],
                            'template' => '<a href="{url}" data-method="post">{icon}{label}</a>',],
                        ['label' => 'Login', 'icon' => 'fas fa-sign-in', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ],
                ]
        )
        ?>

    </section>

</aside>
