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
                        ['label' => 'Master Barang Waka', 'icon' => 'fas fa-table', 'url' => ['barang/indexWaka']],
                        ['label' => 'Daftar Pengajuan', 'icon' => 'fa-edit', 'url' => ['/persetujuan/index']],
                        ['label' => 'Daftar Persetujuan', 'icon' => 'fa-edit', 'url' => ['/persetujuan/riwayat']],
                        ['label' => 'Laporan', 'icon' => 'fas fa-file', 'url' => ['/#']],
                        ['label' => 'Pengaturan Akun', 'icon' => 'fas fa-user', 'url' => ['/site/index']],
                        ['label' => 'Keluar', 'icon' => 'fas fa-sign-out-alt', 'url' => ['/site/login']],
                        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ],
                ]
        )
        ?>

    </section>

</aside>
