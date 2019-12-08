<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */

$this->title = 'Kirim Pesan: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Vendor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Kirim Pesan';
?>
<div class="vendor-create">
<!-- 
    <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_formemail', [
        'model' => $model,
    ]) ?>

</div>
