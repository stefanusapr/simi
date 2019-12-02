<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengajuan */

$this->title = 'Edit Pengajuan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengajuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="pengajuan-update">
    <?= $this->render('_form', [
        'model' => $model,
        'modelDetail' => $modelDetail,
    ]) ?>

</div>
