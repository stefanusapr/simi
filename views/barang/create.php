<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = 'Tambah Barang';
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
