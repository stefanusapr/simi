<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Sistem Informasi Manajemen Inventaris Sarana dan Prasarana';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">

            <div class="login-logo">
                <?= Html::encode($this->title) ?>
            </div>

            <?php
            $form = ActiveForm::begin([
                        'id' => 'login-form',
            ]);
            ?>
            <div class="mb-3">
                <?= $form->field($model, 'username')->label(false)->input('username', ['placeholder' => 'Nama Pengguna']) ?>
            </div>
            <div class="mb-3">
                <?= $form->field($model, 'password')->label(false)->input('password', ['placeholder' => 'Kata Sandi']) ?>
            </div>
            <div class="mb-8">
                <!--                <div class="icheck-primary">
                                    <?pjp //echo 
                                    $form->field($model, 'rememberMe')->checkbox([
                                        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                        'label' => "Ingat saya",
                                    ])
                                    ?>
                                </div>-->
                <!-- /.col -->
                <div class="col-6">
                    <?=
                    Html::submitButton('Masuk', [
                        'class' => 'btn btn-primary',
                        'name' => 'login-button'
                    ])
                    ?>
                </div>
                <!-- /.col -->
            </div>
<?php ActiveForm::end(); ?>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
