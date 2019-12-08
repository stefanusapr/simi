<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Vendor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendor-view">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Tambah', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Anda yakin ingin menghapus?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-list"></span> List Vendor'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-envelope"></span> Kirim'), ['email', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nama',
            'alamat:ntext',
            'no_hp',
            'email:email',
            'keterangan:ntext',
        ],
    ])
    ?>

</div>
