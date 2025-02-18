<?php

/**
 * @var Author $author
 * @var Subscription $model
 */

use app\models\Author;
use app\models\Subscription;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Подписка на ' . $author->full_name;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'phone')->textInput(['placeholder' => 'Введите номер телефона']) ?>
<?= Html::activeHiddenInput($model, 'author_id', ['value' => $author->id]) ?>
<div class="form-group">
    <?= Html::submitButton('Подписаться', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
