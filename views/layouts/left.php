<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Petugas Sarpras</p>
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
                        ['label' => 'Dashboard', 'icon' => 'fas fa-dashboard', 'url' => ['site/index']],
                        ['label' => 'Master Barang', 'icon' => 'fas fa-table', 'url' => ['barang/index']],
                        ['label' => 'Pengajuan', 'icon' => 'fas fa-edit', 'url' => ['pengajuan/index']],
                        ['label' => 'Transaksi Masuk', 'icon' => 'fas fa-share', 'url' => ['transaksi-masuk/index']],
                        ['label' => 'Transaksi Keluar', 'icon' => 'fas fa-reply', 'url' => ['transaksi-keluar/index']],
                        ['label' => 'Peminjaman', 'icon' => 'fas fa-hand-paper', 'url' => ['peminjaman/index']],
                        ['label' => 'Data Vendor', 'icon' => 'fas fa-truck', 'url' => ['vendor/index']],
                        ['label' => 'Daftar Pengajuan', 'icon' => 'fa-edit', 'url' => ['/persetujuan/index']],
                        ['label' => 'Daftar Persetujuan', 'icon' => 'fa-edit', 'url' => ['/persetujuan/index-persetujuan']],
                        ['label' => 'Laporan', 'icon' => 'fas fa-file', 'url' => ['/#']],
                        ['label' => 'Pengaturan Akun', 'icon' => 'fas fa-user', 'url' => ['site/index']],
                        ['label' => 'Keluar', 'icon' => 'fas fa-sign-out-alt', 'url' => ['site/logout'],
                            'template' => '<a href="{url}" data-method="post">{icon}{label}</a>',],
                        ['label' => 'Login', 'icon' => 'fas fa-sign-in', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ],
                ]
        )
        ?>

    </section>

</aside>
