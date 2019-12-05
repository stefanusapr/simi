<?php

use yii\helpers\Html;
use yii\grid\GridView;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
echo Html::a('<i class="fas far fa-hand-point-up"></i> Privacy Statement', ['/site/view-privacy'], [
    'class' => 'btn btn-danger',
    'target' => '_blank',
    'data-toggle' => 'tooltip',
    'title' => 'Will open the generated PDF file in a new window'
]);
?>