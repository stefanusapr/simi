<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel fixed">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Petugas Sarpras</p>
            </div>
        </div>

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    'items' => [
                        ['label' => 'Inventaris Barang', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'fas fa-dashboard', 'url' => ['site/index']],
                        ['label' => 'Master Barang', 'icon' => 'fas fa-table', 'url' => ['barang/index']],
                        ['label' => 'Pengajuan', 'icon' => 'fas fa-edit', 'url' => ['pengajuan/index']],
                        ['label' => 'Persetujuan', 'icon' => 'fas fa-tasks', 'url' => ['pengajuan/index-persetujuan']],
                        ['label' => 'Transaksi Masuk', 'icon' => 'fas fa-share', 'url' => ['transaksi-masuk/index']],
                        ['label' => 'Transaksi Keluar', 'icon' => 'fas fa-reply', 'url' => ['transaksi-keluar/index']],
                        ['label' => 'Peminjaman',
                            'icon' => 'fas fa-hand-paper',
                            'url' => ['peminjaman/index'],
                            'template' => '<a href="{url}" >{icon}{label}<i class="fas fa-angle-left pull-right"></i></a>',
                            'items' => [
                                ['label' => 'Peminjaman', 'icon' => 'fas fa-hand-paper', 'url' => ['peminjaman/index']],
                                ['label' => 'Riwayat Peminjaman', 'icon' => 'fas fa-history', 'url' => ['peminjaman/index-riwayat']],
                            ],
                        ],
                        ['label' => 'Data Vendor', 'icon' => 'fas fa-truck', 'url' => ['vendor/index']],
//                        ['label' => 'Daftar Pengajuan', 'icon' => 'fa-edit', 'url' => ['/persetujuan/index']],
//                        ['label' => 'Daftar Persetujuan', 'icon' => 'fa-edit', 'url' => ['/persetujuan/riwayat']],
                        //['label' => 'Laporan', 'icon' => 'fas fa-file', 'url' => ['/barang/report']],
//                        ['label' => 'Laporan',
//                            'icon' => 'fas fa-file',
//                            'url' => ['/#'],
//                            'template' => '<a href="{url}" >{icon}{label}<i class="fas fa-angle-left pull-right"></i></a>',
//                            'items' => [
//                                ['label' => 'Transaksi Masuk', 'icon' => 'fas fa-file', 'url' => ['transaksi-masuk/report']],
//                                ['label' => 'Transaksi Keluar', 'icon' => 'fas fa-file', 'url' => ['transaksi-keluar/report']],
//                            ],
//                        ],
                        ['label' => 'Pengaturan Akun', 'icon' => 'fas fa-user', 'url' => ['site/akun']],
                        ['label' => 'Keluar', 'icon' => 'fas fa-sign-out-alt', 'url' => ['site/logout'],
                            'template' => '<a href="{url}" data-method="post">{icon}{label}</a>',],
                        ['label' => 'Login', 'icon' => 'fas fa-sign-in', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ],
                ]
        )
        ?>

    </section>

</aside>
