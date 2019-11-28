<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */

$this->title = 'Update Vendor: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Vendor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->nama]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendor-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
