<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var User $user
 */

$this->title = 'Login';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($user, 'username') ?>
<?= $form->field($user, 'password_hash')->passwordInput() ?>
<div class="form-group">
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
