<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengajuan */

$this->title = 'Tambah Pengajuan';
$this->params['breadcrumbs'][] = ['label' => 'Pengajuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-create">
    <?=
    $this->render('_form', [
        'model' => $model,
        'modelDetail' => $modelDetail,
    ])
    ?>

</div>
